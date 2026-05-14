# Deploy ke InfinityFree

## Persiapan

### 1. Daftar & Buat Hosting
- Daftar di [infinityfree.com](https://www.infinityfree.com)
- Buat akun hosting baru (pilih subdomain gratis atau pakai domain sendiri)
- Catat: FTP hostname, username, password dari panel

### 2. Buat Database MySQL
- Masuk ke Control Panel → MySQL Databases
- Buat database baru, catat: DB name, DB username, DB password, DB host

### 3. Build Assets Lokal
```bash
npm run build
composer install --no-dev --optimize-autoloader
```

## Struktur Upload (FTP)

InfinityFree punya document root di `htdocs/`. Struktur upload:

```
/home/username/
├── portofolio/                ← Upload semua KECUALI isi public/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/               ← WAJIB upload (tidak bisa composer install di server)
│   ├── .env                  ← Buat manual di server
│   ├── artisan
│   └── composer.json
│
└── htdocs/                    ← Upload isi folder public/ ke sini
    ├── .htaccess
    ├── index.php              ← EDIT path (lihat langkah 4)
    ├── favicon.ico
    ├── robots.txt
    ├── build/                 ← Hasil npm run build
    └── images/
```

### 4. Edit `index.php` di `htdocs/`

Setelah upload, edit `htdocs/index.php` — ubah path `../` menjadi path ke folder Laravel:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Path ke folder Laravel (sesuaikan dengan struktur hosting kamu)
$laravelPath = __DIR__ . '/../portofolio';

if (file_exists($maintenance = $laravelPath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require $laravelPath.'/vendor/autoload.php';

/** @var Application $app */
$app = require_once $laravelPath.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

### 5. Buat `.env` di Server

Buat file `.env` di folder `portofolio/` via File Manager di Control Panel:

```env
APP_NAME=Portfolio
APP_ENV=production
APP_KEY=base32:GENERATE_KEY_DISINI
APP_DEBUG=false
APP_URL=https://subdomain-kamu.infinityfreeapp.com

DB_CONNECTION=mysql
DB_HOST=sql123.infinityfree.com
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=username_database_kamu
DB_PASSWORD=password_database_kamu

SESSION_DRIVER=file
CACHE_STORE=file
```

Generate APP_KEY lokal: `php artisan key:generate --show`

### 6. Set Permissions

Via File Manager, set folder permissions:
- `portofolio/storage/` → 775
- `portofolio/bootstrap/cache/` → 775

### 7. Jalankan Migration

InfinityFree tidak support SSH, jadi buat route sementara untuk migration:

Tambahkan di `routes/web.php` (HAPUS setelah selesai!):
```php
Route::get('/setup-db', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration done!';
});
```

Akses `https://domain-kamu/setup-db` sekali, lalu hapus route tersebut.

## Tools Upload

Gunakan **FileZilla** (FTP client gratis):
- Host: dari panel InfinityFree
- Username: dari panel
- Password: dari panel
- Port: 21

## Catatan Penting

- InfinityFree TIDAK support `composer install` atau `npm` di server
- Upload folder `vendor/` dan `public/build/` dari lokal
- Jangan upload `.env`, `node_modules/`, `.git/`
- InfinityFree punya rate limit dan kadang lambat — normal untuk free hosting
- File upload max ~10MB per file via FTP
