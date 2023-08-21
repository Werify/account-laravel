<?php

use Illuminate\Support\Facades\Route;
use Werify\Account\Laravel\Http\Controllers\V1\Auth\Classic\WebController;
use Werify\Account\Laravel\Http\Controllers\V1\Authorize\Classic\WebController as AuthorizeWebController;

Route::prefix(config('waccount.routes.web.prefix'))->group(function () {

    Route::prefix('auth')->name('auth.')->group(function(){
        Route::prefix('classic')->name('classic.')->controller(WebController::class)->group(function(){
            Route::post('logout', 'logout')->name('logout');
        });
    });

    // Authorize
    Route::prefix('authorize')->name('authorize.')->group(function(){
        Route::prefix('classic')->name('classic.')->controller(AuthorizeWebController::class)->group(function(){
            Route::post('start', 'start')->name('start');
            Route::post('check', 'check')->name('check');
        });
    });

});