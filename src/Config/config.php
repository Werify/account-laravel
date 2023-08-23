<?php

return [

    // General
    'sandbox' => env('WA_SANDBOX_MODE', false),
    'debug' => env('APP_DEBUG', false),
    'client_id' => env('WA_CLIENT_ID', 'sandbox'),
    'client_secret' => env('WA_CLIENT_SECRET', 'sandbox'),
    'login_route' => env('WA_LOGIN_ROUTE', 'waccount.web.authorize.classic.start'),
    'home_route' => env('WA_HOME_ROUTE', 'home'),
    'logout_route' => env('WA_LOGOUT_ROUTE', 'index'),

    // Session
    'session' => [
        'driver' => env('WA_SESSION_DRIVER', 'file'),
        'variable' => env('WA_SESSION_VARIABLE', 'user'),
        'view_variable' => env('WA_SESSION_VIEW_VARIABLE', true),
    ],

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
                    'logout' => 'auth/classic/logout',
                ],
            ],
            'authorize' => [
                'classic' => [
                    'start' => 'authorize/classic/start',
                    'check' => 'authorize/classic/check',
                ],
            ],
            'profile' => [
                'me' => 'profile/me',
                'update' => 'profile',
            ],
        ],
    ],

    // Routes
    'routes' => [
        'api' => [
            'enabled' => env('WA_ROUTES_API_ENABLED', false),
            'prefix' => env('WA_ROUTES_API_PREFIX', 'waccount/api'),
            'name' => env('WA_ROUTES_API_NAME', 'waccount.api.'),
        ],
        'web' => [
            'enabled' => env('WA_ROUTES_WEB_ENABLED', false),
            'prefix' => env('WA_ROUTES_WEB_PREFIX', 'waccount/web'),
            'name' => env('WA_ROUTES_WEB_NAME', 'waccount.web.'),
        ],
    ],

];
