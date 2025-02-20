<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the CORS (Cross-Origin Resource Sharing) configuration
    | for your application. You can configure the behavior of CORS requests here,
    | allowing you to specify which domains, methods, and headers are allowed.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Atur agar API bisa diakses dan semua route boleh
    'allowed_methods' => ['*'], // Izinkan semua metode HTTP seperti GET, POST, PUT, DELETE, dll
    'allowed_origins' => [
        'http://localhost:3000', // Izinkan permintaan dari Next.js yang berjalan di localhost:3000
    ],
    'allowed_origins_patterns' => [], // Anda bisa menambahkan pola domain lain jika diperlukan
    'allowed_headers' => ['*'], // Izinkan semua header
    'exposed_headers' => [], // Menentukan header mana yang akan diekspos
    'max_age' => 0, // Durasi cache pre-flight request
    'supports_credentials' => false, // Jika true, izinkan pengiriman cookie/credentials

    /*
    |--------------------------------------------------------------------------
    | CORS Configuration For Specific Origins
    |--------------------------------------------------------------------------
    |
    | If you want to allow different CORS settings for specific domains, you can
    | add those here. You can also adjust settings based on the domain the request
    | is coming from.
    |
    */
    'allowed_origins' => [
        'http://localhost:3000', // Domain frontend Next.js
        // 'http://other-frontend.com', // Jika ada domain lain yang ingin diizinkan
    ],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'], // Atur metode HTTP yang diizinkan
    'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With'], // Atur header yang diizinkan

    'exposed_headers' => ['X-Total-Count', 'Authorization'], // Header yang dapat diakses oleh browser
    'max_age' => 3600, // Cache pre-flight request selama 1 jam
    'supports_credentials' => true, // Jika menggunakan cookies atau header credentials
];
