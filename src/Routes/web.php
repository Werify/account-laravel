<?php

use Illuminate\Support\Facades\Route;
use Werify\Account\Laravel\Http\Controllers\V1\Auth\Classic\WebController;
use Werify\Account\Laravel\Http\Controllers\V1\Authorize\Classic\WebController as AuthorizeWebController;

Route::prefix(config('waccount.routes.web.prefix'))->name(config('waccount.routes.web.name'))->middleware('web')->group(function () {

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::prefix('classic')->name('classic.')->controller(WebController::class)->group(function () {
            Route::get('logout', 'logout')->name('logout')->middleware('wauth');
        });
    });

    // Authorize
    Route::prefix('authorize')->name('authorize.')->group(function () {
        Route::prefix('classic')->name('classic.')->controller(AuthorizeWebController::class)->group(function () {
            Route::get('start', 'start')->name('start');
            Route::get('check', 'check')->name('check');
        });
    });

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('locale', 'locale')->name('locale');
        Route::get('dark-mode', 'darkMode')->name('darkMode');
    });

});
