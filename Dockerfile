FROM php:8.2-fpm-alpine AS builder

RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        mbstring \
        pcntl \
        bcmath

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache nodejs npm

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

COPY package.json package-lock.json* ./
RUN npm ci && npm run build

COPY . .

FROM php:8.2-fpm-alpine AS production

RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        mbstring \
        pcntl \
        bcmath

WORKDIR /var/www/html

COPY --from=builder /var/www/html/vendor ./vendor
COPY --from=builder /var/www/html/public/build ./public/build
COPY --from=builder /var/www/html/public/hot ./public/hot
COPY --from=builder /var/www/html/bootstrap ./bootstrap
COPY --from=builder /var/www/html/storage ./storage
COPY --from=builder /var/www/html/public ./public
COPY --from=builder /var/www/html/public/index.php ./public/index.php

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN mkdir -p /etc/nginx/http.d /etc/supervisor/conf.d

COPY <<EOF /etc/nginx/http.d/default.conf
server {
    index index.php index.html;
    error_log /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/html/public;
    client_max_body_size 100M;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \\.php\$ {
        fastcgi_split_path_info ^(.+\\.php)(/.+)\$;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param PATH_INFO \$fastcgi_path_info;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~* \\.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
EOF

COPY <<EOF /etc/supervisor/conf.d/laravel.conf
[program:laravel]
command=sh -c "php-fpm && nginx -g 'daemon off;'"
autostart=true
autorestart=true
stderr_logfile=/var/log/laravel.err.log
stdout_logfile=/var/log/laravel.out.log
EOF

COPY <<EOF /usr/local/bin/start.sh
#!/bin/bash
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Starting services..."
exec supervisord -c /etc/supervisor/conf.d/laravel.conf
EOF

RUN chmod +x /usr/local/bin/start.sh

EXPOSE 10000

CMD ["/usr/local/bin/start.sh"]