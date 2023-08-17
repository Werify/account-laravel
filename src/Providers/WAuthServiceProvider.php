<?php
namespace Werify\Account\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class WAuthServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'waccount');
    }

    public function boot()
    {
        Auth::extend('wauth', function ($app, $name, array $config) {
            // Return an instance of your custom authentication guard
            return new CustomAuthGuard($app['request']);
        });
    }

}