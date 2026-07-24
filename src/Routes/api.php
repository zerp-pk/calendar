<?php

use Illuminate\Support\Facades\Route;
use Zerp\Calendar\Http\Controllers\Api\EventsApiController;
use Zerp\Calendar\Http\Controllers\Api\SettingsApiController;

Route::prefix('api')->middleware(['api.json'])->group(function () {
    Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'calendar', 'as' => 'api.calendar.'], function () {
        // Aggregated calendar feed (read only - events belong to other modules).
        Route::get('events', [EventsApiController::class, 'index'])->name('events');

        // Google Calendar integration settings.
        Route::get('settings', [SettingsApiController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingsApiController::class, 'update'])->name('settings.update');
    });
});
