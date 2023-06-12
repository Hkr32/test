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
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'name' => 'test-app',
    ],
    'routes' => [
        '/' => \App\Http\Controllers\IndexController::class,
        '/code' => [\App\Http\Controllers\PromoCodeController::class, 'getUserCode'],
    ],
    'views' => [
        'path' => '/resources/views',
    ],
];
