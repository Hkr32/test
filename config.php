<?php

return [
    'app' => [
        'name' => 'Awesome Promo Code',
        'partner' => [
            'link' => 'https://google.com/',
            'param' => 'query',
        ],
    ],
    'db' => [
        'host' => env('DB_HOST'),
        'user' => env('DB_USER'),
        'password' => env('DB_PASSWORD'),
        'name' => env('DB_NAME'),
    ],
    'routes' => [
        '/' => \App\Http\Controllers\IndexController::class,
        '/code' => [\App\Http\Controllers\PromoCodeController::class, 'getUserCode'],
    ],
    'views' => [
        'path' => '/resources/views',
    ],
];
