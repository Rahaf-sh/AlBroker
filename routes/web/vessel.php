<?php

use App\Http\Controllers\Dashboard\Vessel\VesselController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::resource('vessel',VesselController::class);
});
