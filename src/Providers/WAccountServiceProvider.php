<?php

namespace Werify\Account\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Werify\Account\Laravel\Http\Middleware\V1\WApi;
use Werify\Account\Laravel\Http\Middleware\V1\WAuth;

class WAccountServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'waccount');
    }

    public function boot()
    {
        app('router')->aliasMiddleware('wauth', WAuth::class);
        app('router')->aliasMiddleware('wapi', WApi::class);
        if (config('waccount.routes.api.enabled')) {
            $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        }
        if (config('waccount.routes.web.enabled')) {
            $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../Config/config.php' => config_path('waccount.php'),
            ], 'waccount-config');
        }
    }
}
