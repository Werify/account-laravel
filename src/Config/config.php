<?php

return [

    // General
    'sandbox' => env('WA_SANDBOX_MODE', false),
    'debug' => env('APP_DEBUG', false),
    'client_id' => env('WA_CLIENT_ID', 'sandbox'),
    'client_secret' => env('WA_CLIENT_SECRET', 'sandbox'),
    'cookie_name' => env('WA_COOKIE_NAME', 'waccount_token'),
    'login_route' => env('WA_LOGIN_ROUTE', 'login'),

    // API
    'api' => [
        'url' => env('WA_API_URL', 'https://account.werify.net/api'),
        'sandbox_url' => env('WA_SANDBOX_API_URL', 'https://sandbox.account.werify.net/api'),
        'version' => 'v1',
        'endpoints' => [
            'auth' => [
                'classic' => [
                    'login' => 'auth/classic/login',
                    'register' => 'auth/classic/register',
                    'me' => 'auth/classic/me',
                ],
            ],
        ]
    ],

    // Routes
    'routes' => [
        'enabled' => env('WA_ROUTES_ENABLED', false),
        'prefix' => env('WA_ROUTES_PREFIX', 'waccount'),
    ],

];