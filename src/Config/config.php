<?php

return [

    // General
    'sandbox' => env('WA_SANDBOX_MODE', false),
    'debug' => env('APP_DEBUG', false),
    'client_id' => env('WA_CLIENT_ID', 'sandbox'),
    'client_secret' => env('WA_CLIENT_SECRET', 'sandbox'),
    'cookie_name' => env('WA_COOKIE_NAME', 'waccount_token'),
    'login_route' => env('WA_LOGIN_ROUTE', 'login'),
    'home_route' => env('WA_HOME_ROUTE', 'home'),
    'logout_route' => env('WA_LOGOUT_ROUTE', 'logout'),

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
                    'logout' => 'auth/classic/logout'
                ],
            ],
            'authorize' => [
                'classic' => [
                    'start' => 'authorize/classic/start',
                    'check' => 'authorize/classic/check',
                ]
            ]
        ]
    ],

    // Routes
    'routes' => [
        'api' => [
            'enabled' => env('WA_ROUTES_API_ENABLED', false),
            'prefix' => env('WA_ROUTES_API_PREFIX', 'waccount/api'),
            'name' => env('WA_ROUTES_API_NAME', 'waccount.api'),
        ],
        'web' => [
            'enabled' => env('WA_ROUTES_WEB_ENABLED', false),
            'prefix' => env('WA_ROUTES_WEB_PREFIX', 'waccount/web'),
            'name' => env('WA_ROUTES_WEB_NAME', 'waccount.web'),
        ],
    ],

];