<?php
namespace Bulutly\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class BulutlyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'bulutly');
    }

    public function boot()
    {
        if (config('bulutly.routes.enabled')){
            $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../Config/config.php' => config_path('bulutly.php'),
            ], 'config');
        }
    }

}