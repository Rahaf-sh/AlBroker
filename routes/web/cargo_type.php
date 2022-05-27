<?php

use App\Http\Controllers\Dashboard\CargoType\CargoTypeController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::resource('cargo_type', CargoTypeController::class);
});
