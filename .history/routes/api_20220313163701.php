<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Cargo\CargoController;
//use App\Http\Controllers\Api\ContactUsChat\ContactUsChatController;
use App\Http\Controllers\Api\GeneralText\GeneralTextController;
use App\Http\Controllers\Api\Location\CityController;
use App\Http\Controllers\Api\Location\CountryController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\Api\Profile\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Api\Notification\NotificationProfilesController;
use App\Http\Controllers\Api\Plans\PlansController;
use App\Http\Controllers\Api\Vessel\VesselController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('resetPassword', [ProfileController::class, 'resetPassword']);
    Route::post('new_register', [AuthController::class, 'register']);
    Route::post('new_register/social', [AuthController::class, 'social']);
    Route::post('data/check', [AuthController::class, 'checkData']);
    Route::post('send/code/email', [AuthController::class, 'sendCode']);
    Route::post('code/email/verify_code', [AuthController::class, 'verifyCode']);
});

/**Auth Routes**/
Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'contact_us', 'middleware' => "CheckStatus"], function () {
        //Route::post('/message/send', [ContactUsChatController::class, 'store']);
        //Route::get('/chat/get', [ContactUsChatController::class, 'getChat']);
    });
    Route::group(['prefix' => 'profile', 'middleware' => "CheckStatus"], function () {
        Route::post('change/image', [AuthController::class, 'changeImage']);
        Route::post('change/email', [ProfileController::class, 'updateProfile']);
        Route::post('change/password', [ProfileController::class, 'updatePassword']);
        Route::post('update/me', [ProfileController::class, 'updateProfile']);
        Route::post('changeLang', [ProfileController::class, 'changeLangApp']);
        Route::post('status/account/{status}', [ProfileController::class, 'changeStatus']);
    });

    Route::group(['prefix' => 'vessel', 'middleware' => "CheckStatus"], function () {
        Route::post('create', [VesselController::class, 'store']);
        Route::get('show/{id}', [VesselController::class, 'show']);
        Route::post('update', [VesselController::class, 'update']);
        Route::post('delete', [VesselController::class, 'delete']);
        Route::get('all', [VesselController::class, 'myIndex']);
        Route::get('activePlan', [PlansController::class, 'activePlan']);
    });


    Route::group(['prefix' => 'cargo', 'middleware' => "CheckStatus"], function () {
        Route::post('create', [CargoController::class, 'store']);
        Route::post('updateStatus', [CargoController::class, 'updateStatus']);
        Route::post('interseted', [CargoController::class, 'interseted']);
        Route::post('moveToMain', [CargoController::class, 'moveToMain']);
        Route::post('operations/store', [CargoController::class, 'storeOperations']);
        Route::get('show/{id}', [CargoController::class, 'show']);
        Route::post('update', [CargoController::class, 'update']);
        Route::post('delete', [CargoController::class, 'delete']);
        Route::get('get/contract/{id}', [CargoController::class, 'getPDF']);
        Route::post('upload/contract', [CargoController::class, 'upload_contract']);
        Route::get('all', [CargoController::class, 'myIndex']);
    });
    /* Tokens Routes */
    Route::group(['prefix' => 'token', 'middleware' => "CheckStatus"], function () {
        Route::post('/set', [\App\Http\Controllers\Api\UserTokens\UserTokensController::class, 'store']);
        Route::get('/get', [\App\Http\Controllers\Api\UserTokens\UserTokensController::class, 'getTokens']);
    });

    Route::group(['prefix' => 'notification', 'middleware' => "CheckStatus"], function () {
        Route::post('/profile', [NotificationProfilesController::class, 'storeOrDestroy']);
        Route::post('/read', [NotificationProfilesController::class, 'read']);
        Route::get('/list', [NotificationProfilesController::class, 'list']);
    });

    Route::group(['prefix' => 'payment', 'middleware' => "CheckStatus"], function () {
        Route::post('pay/plan', [PlansController::class, 'payPlan']);
    });
});

//PUBLIC ROUTES //

Route::get('country/all', [CountryController::class, 'index']);
Route::get('general_text', [GeneralTextController::class, 'index']);
Route::get('payment/brands', [PaymentController::class, 'index']);
Route::get('country/{id}/get', [CountryController::class, 'getById']);
Route::get('city/all', [CityController::class, 'index']);
Route::get('cargo/types/list', [CargoController::class, 'types']);
Route::get('city/{id}/get', [CityController::class, 'getById']);

Route::get('home', [HomeController::class, 'home']);
Route::get('public/cargo/list', [CargoController::class, 'publicIndex'])->middleware('auth:api');
Route::get('home/posts', [HomeController::class, 'indexItems']);
Route::get('public/profile/info', [ProfileController::class, 'user2']);
Route::get('public/general/sentence', [GeneralTextController::class, 'indexSentence']);
Route::get('public/plans/all', [PlansController::class, 'index']);

Route::get('view/pay/plan', [PlansController::class, 'viewPayment'])->name('api.plan.paymentview');
Route::get('view/payment/result', [PlansController::class, 'resultView'])->name('api.plan.resultView');
Route::post('view/payment/sendData', [PlansController::class, 'paymentForm'])->name('api.plan.paymentForm');

Route::get('public/vessel/all', [VesselController::class, 'index']);


Route::get('pdf', function(){


});
