<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->namespace('tyasa81\EzLoggable\Http\Controllers\Api\v1')->group(function () {
    Route::prefix('loggables')->middleware(['auth:sanctum', 'ability:dashboard'])->group(function () {
        Route::get('/', 'LoggableController@list');
    });
});
