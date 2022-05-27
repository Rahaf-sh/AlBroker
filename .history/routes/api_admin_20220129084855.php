<?php

use App\Http\Controllers\Api\Admin\ContactUs\ContactUsController;
use App\Http\Controllers\Api\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Api\Admin\GeneralText\GeneralTextController as GeneralTextGeneralTextController;
use App\Http\Controllers\Api\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Api\Admin\Prouduct\ProductController;
use App\Http\Controllers\Api\Admin\ReportMessages\ReportMessagesController;
use App\Http\Controllers\Api\Admin\Role\RoleController;
use App\Http\Controllers\Api\Admin\Users\UserController;

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => "admin", 'middleware' => 'auth:api'], function () {

    Route::group(['prefix' => 'contact_us/messages'], function () {
        Route::get('/all', [ContactUsController::class, 'index']);
        Route::post('/reply', [ContactUsController::class, 'reply']);
        Route::get('/{id}', [ContactUsController::class, 'show']);
    });

    Route::group(['prefix' => 'notification'], function () {
        Route::get('sent/all', [AdminNotificationController::class, 'index']);
        Route::post('/store', [AdminNotificationController::class, 'store']);
    });

    Route::group(['prefix' => 'general_text'], function () {
        Route::get('/all', [GeneralTextGeneralTextController::class, 'index']);
        Route::post('/updateOrCreate', [GeneralTextGeneralTextController::class, 'store']);
        Route::post('/delete', [GeneralTextGeneralTextController::class, 'destroy']);
        Route::get('/{id}', [GeneralTextGeneralTextController::class, 'show']);
    });
    
 

   
});
