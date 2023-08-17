<?php

return [

    // General
    'sandbox' => env('BLT_SANDBOX_MODE', false),
    'debug' => env('APP_DEBUG', false),

    // API
    'api' => [
        'url' => env('BLT_API_URL', 'https://bulutly.net/api'),
        'sandbox_url' => env('BLT_SANDBOX_API_URL', 'https://sandbox.bulutly.net/api'),
        'key' => env('BLT_API_KEY', 'sandbox'),
        'version' => 'v1',
        'endpoints' => [
            'projects' => [
                'index' => 'projects',
                'store' => 'projects',
                'show' => 'projects/{uuid}',
                'update' => 'projects/{uuid}',
                'delete' => 'projects/{uuid}',
            ],
            'buluts' => [
                'index' => 'buluts',
                'store' => 'buluts',
                'show' => 'buluts/{uuid}',
                'update' => 'buluts/{uuid}',
                'delete' => 'buluts/{uuid}',
                'envs' => [
                    'index' => 'buluts/{uuid}/envs',
                    'store' => 'buluts/{uuid}/envs',
                    'update' => 'buluts/{uuid}/envs/{env_uuid}/edit',
                    'delete' => 'buluts/{uuid}/envs/{env_uuid}/delete',
                ],
            ],
            'images' => [
                'index' => 'images',
            ],
        ]
    ],

    // Routes
    'routes' => [
        'enabled' => env('BLT_ROUTES_ENABLED', false),
        'prefix' => env('BLT_ROUTES_PREFIX', 'bulutly'),
    ],

];