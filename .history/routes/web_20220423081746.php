<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/v', function () {
    return view('Resetpassword.ResetPassword1');
});

Route::get('/sym', function () {
    $target = '/home1/urcloset/app_105/storage/app/public';
    $shortcut = '/home1/urcloset/public_html/storage';
    symlink($target, $shortcut);
    echo "created";
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['as' => 'dashboard.'], function () {
        Route::get('/', [\App\Http\Controllers\Dashboard\Dashboard\DashboardController::class, 'index'])->name('index');
    });
    Route::get('/logout', [\App\Http\Controllers\Dashboard\Auth\AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [\App\Http\Controllers\Dashboard\Auth\AuthController::class, 'showLoginForm'])->name('PageLogin');
    Route::post('/login', [\App\Http\Controllers\Dashboard\Auth\AuthController::class, 'login'])->name('login');
    if (!auth()) {
        Route::get('{any}', function () {
            return redirect(\route('dashboard.PageLogin'));
        })->where('any', '.*');
    }
});


Route::get('logs', [\Arcanedev\LogViewer\Http\Controllers\LogViewerController::class, 'index']);
