<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {

        Route::get('/{key}', [\App\Http\Controllers\Dashboard\AppSetting\SettingController::class, 'index'])->name('index');

        Route::get('/{key}/edit', [\App\Http\Controllers\Dashboard\AppSetting\SettingController::class, 'edit'])->name('edit');

        Route::post('/update', [\App\Http\Controllers\Dashboard\AppSetting\SettingController::class, 'update'])->name('update');

    });
});
