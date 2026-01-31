<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::as('api.')->group(callback: function () {
    Route::get('/properties', [PropertyController::class, 'index'])
        ->name('properties.index');
});
