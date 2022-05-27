<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::group(['prefix' => 'plan', 'as' => 'plan.'], function () {

        Route::get('/', [\App\Http\Controllers\Dashboard\AppSetting\SettingController::class, 'index'])->name('index');

        Route::get('/edit', [\App\Http\Controllers\Dashboard\AppSetting\SettingController::class, 'edit'])->name('edit');

        Route::post('/update', [\App\Http\Controllers\Dashboard\AppSetting\SettingController::class, 'update'])->name('update');

    });
});
