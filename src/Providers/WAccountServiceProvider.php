<?php
namespace Werify\Account\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class WAccountServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'waccount');
    }

    public function boot()
    {
        if (config('waccount.routes.enabled')){
            $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../Config/config.php' => config_path('waccount.php'),
            ], 'config');
        }
    }

}