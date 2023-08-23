<?php

use Illuminate\Support\Facades\Route;
use Werify\Account\Laravel\Http\Controllers\V1\Auth\Classic\ApiController;
use Werify\Account\Laravel\Http\Controllers\V1\Authorize\Classic\ApiController as ClassicControllerAlias;
use Werify\Account\Laravel\Http\Controllers\V1\Profile\ApiController as ProfileApiController;

Route::prefix(config('waccount.routes.api.prefix'))->name(config('waccount.routes.api.name'))->group(function () {

    // Auth
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::prefix('classic')->name('classic.')->controller(ApiController::class)->group(function () {
            Route::post('login', 'login')->name('login');
            Route::post('register', 'register')->name('register');
            Route::post('logout', 'logout')->name('logout');
        });
    });

    // Authorize
    Route::prefix('authorize')->name('authorize.')->group(function () {
        Route::prefix('classic')->name('classic.')->controller(ClassicControllerAlias::class)->group(function () {
            Route::post('start', 'start')->name('start');
            Route::post('check', 'check')->name('check');
        });
    });

    // Profile
    Route::prefix('profile')->name('profile.')->middleware('wauth')->controller(ProfileApiController::class)->group(function () {
        Route::get('me', 'me')->name('me');
        Route::put('update', 'update')->name('update');
    });

});
