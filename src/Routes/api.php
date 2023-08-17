<?php

use Bulutly\Laravel\Http\Controllers\BulutController;
use Bulutly\Laravel\Http\Controllers\ENVController;
use Bulutly\Laravel\Http\Controllers\ImageController;
use Bulutly\Laravel\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('bulutly.routes.prefix'))->group(function () {

    // Projects
    Route::prefix('Projects')->name('Projects.')->controller(ProjectController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{uuid}', 'show')->name('show');
        Route::put('/{uuid}', 'update')->name('show');
        Route::delete('/{uuid}', 'delete')->name('delete');
    });

    // Buluts
    Route::prefix('buluts')->name('buluts.')->controller(BulutController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/{uuid}', 'show')->name('show');
        Route::put('/{uuid}', 'update')->name('update');
        Route::delete('/{uuid}', 'delete')->name('delete');

        // ENVs
        Route::prefix('{uuid}/envs')->name('envs.')->controller(ENVController::class)->group(function (){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::put('/{env_uuid}', 'update')->name('update');
            Route::delete('/{env_uuid}', 'delete')->name('delete');
        });

    });

    // Images
    Route::prefix('images')->name('images.')->controller(ImageController::class)->group(function(){
        Route::get('/', 'index')->name('index');
    });
});