<?php

use Illuminate\Support\Facades\Route;
use Werify\Account\Laravel\Http\Controllers\V1\Auth\ClassicController;

Route::prefix(config('waccount.routes.prefix'))->group(function () {

    // Auth
    Route::prefix('auth')->name('auth.')->group(function(){
        Route::prefix('classic')->name('classic.')->controller(ClassicController::class)->group(function(){
            Route::post('login', 'login')->name('login');
            Route::post('register', 'register')->name('register');
        });
    });

});