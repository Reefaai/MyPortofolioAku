<?php

return [
    'owner' => [
        'name' => 'Ahmad rifa`i',
        'email' => 'reefai.ahmd@gmail.com',
        'tagline' => 'ingin menjadi programmer handal namun enggan ngoding ',
        'bio' => 'Saya adalah mahasiswa Rekayasa Perangkat Lunak yang passionate dalam pengembangan web modern. Berpengalaman dalam membangun aplikasi menggunakan Laravel, JavaScript, dan berbagai teknologi web lainnya. Selalu antusias untuk belajar hal baru dan berkontribusi dalam proyek open-source.',
        'photo' => 'images/profile.jpeg',
        'skills' => [
            'PHP',
            'Laravel',
            'JavaScript',
            'HTML & CSS',
            'Tailwind CSS',
            'MySQL',
            'Git',
            'REST API',
            'java',
            'python',
            'c++'
        ],
        'currently_learning' => ['React.js', 'Docker', 'TypeScript', 'System Design'],
        'education' => [
            [
                'institution' => 'STMIK IKMI',
                'program' => 'Rekayasa Perangkat Lunak',
                'year' => '2024 - Sekarang',
                'semester' => 4,
                'status' => 'active',
            ],
        ],
        'social_links' => [
            [
                'platform' => 'GitHub',
                'url' => 'https://github.com/Reefaai',
                'icon' => 'github',
            ],
            [
                'platform' => 'Facebook',
                'url' => 'https://www.facebook.com/Ahmd.Reefai',
                'icon' => 'facebook',
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://www.instagram.com/ahmd.reefai',
                'icon' => 'instagram',
            ],
        ],
    ],

    'projects' => [
        [
            'title' => 'Portfolio Website',
            'description' => 'Website portfolio pribadi dibangun dengan Laravel 12 dan Tailwind CSS untuk menampilkan proyek dan sertifikat.',
            'technologies' => ['Laravel', 'Tailwind CSS', 'Blade'],
            'repository_url' => 'https://github.com/reefai/portfolio',
        ],
        [
            'title' => 'Bestay',
            'description' => 'Sistem reservasi hotel berbasis web yang dibangun dengan Laravel 12, Tailwind CSS 4, dan Alpine.js. Aplikasi ini menyediakan fitur lengkap mulai dari pencarian kamar, booking, pembayaran, hingga panel admin untuk manajemen hotel.',
            'technologies' => ['Laravel', 'Tailwind CSS', 'MySQL'],
            'repository_url' => 'https://github.com/Reefaai/bestay',
        ],
        [
            'title' => 'SaveTube',
            'description' => 'SaveTube adalah aplikasi web pengunduh video yang elegan dan modern. Dibangun dengan framework Laravel, reaktivitas menggunakan Alpine.js, dan antarmuka Tailwind CSS yang di-styling menggunakan skema warna Catppuccin Mocha. Aplikasi ini menggunakan mesin yt-dlp untuk mengunduh video dari berbagai platform seperti YouTube, TikTok, Facebook, dan Instagram.',
            'technologies' => ['Laravel', 'PHP', 'Alpine.js', 'MySQL', 'Tailwind CSS'],
            'repository_url' => 'https://github.com/Reefaai/savetube',
        ],
    ],

    'certificates' => [
        [
            'name' => 'CCNA: Introduction to Networks',
            'issuer' => 'Cisco',
            'year' => 2025,
            'verification_url' => 'https://www.credly.com/badges/613b3a25-8ee1-486a-adf9-f52293d7094b/public_url',
            'image' => 'images/certs/ccna.jpg',
        ],
        [
            'name' => 'C++ Essentials 1',
            'issuer' => 'Cisco',
            'year' => 2025,
            'verification_url' => 'https://www.credly.com/badges/a819f467-d3fd-4a99-b06f-30f1aa732fe8/public_url',
            'image' => 'images/certs/CE.jpg',
        ],
        [
            'name' => 'Cyber Threat Management',
            'issuer' => 'Cisco',
            'year' => 2025,
            'verification_url' => 'https://www.credly.com/badges/d14650e0-c5e9-427f-b205-8cec9ad9d85f/public_url',
            'image' => 'images/certs/CT.jpg',
        ],
        [
            'name' => 'Introduction to Cybersecurity',
            'issuer' => 'Cisco',
            'year' => 2025,
            'verification_url' => 'https://www.credly.com/badges/f3ea68bb-a2c4-48c8-873e-66ac6bd6542e/public_url',
            'image' => 'images/certs/I2C.jpg',
        ],
        [
            'name' => 'Junior Cybersecurity Analyst Career Path',
            'issuer' => 'Cisco',
            'year' => 2025,
            'verification_url' => 'https://www.credly.com/badges/2cbef03c-670f-47c3-974a-e41f98944540/public_url',
            'image' => 'images/certs/CSA.jpg',
        ],
                [
            'name' => 'Python Essentials 1',
            'issuer' => 'Cisco',
            'year' => 2025,
            'verification_url' => 'https://www.credly.com/badges/d4db9894-2f05-4fed-a98a-9d63d732d559/public_url',
            'image' => 'images/certs/PY.jpg',
        ],
    ],
];
