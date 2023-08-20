<?php

use Illuminate\Support\Facades\Route;
use Werify\Account\Laravel\Http\Controllers\V1\Auth\ClassicController;
use Werify\Account\Laravel\Http\Controllers\V1\Authorize\ClassicController as ClassicControllerAlias;

Route::prefix(config('waccount.routes.prefix'))->group(function () {

    // Auth
    Route::prefix('auth')->name('auth.')->group(function(){
        Route::prefix('classic')->name('classic.')->controller(ClassicController::class)->group(function(){
            Route::post('login', 'login')->name('login');
            Route::post('register', 'register')->name('register');
            Route::post('me', 'me')->name('me');
            Route::post('logout', 'logout')->name('logout');
        });
    });

    // Authorize
    Route::prefix('authorize')->name('authorize.')->group(function(){
        Route::prefix('classic')->name('classic.')->controller(ClassicControllerAlias::class)->group(function(){
            Route::post('start', 'start')->name('start');
            Route::post('check', 'check')->name('check');
        });
    });

});