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

Route::get('/home', function () {
    return view('home');
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
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        // Permissions
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');
    
        // Roles
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');
    
        // Users
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
        Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
        Route::resource('users', '\App\Http\Controllers\Admin\UsersController');
    
        // Audit Logs
        Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    
        // Faq Category
        Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
        Route::resource('faq-categories', 'FaqCategoryController');
    
        // Faq Question
        Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
        Route::resource('faq-questions', 'FaqQuestionController');
    
        // Country
        Route::resource('countries', '\App\Http\Controllers\Admin\CountryController');
    
        // City
        Route::resource('cities', '\App\Http\Controllers\Admin\CityController');
    
        // cargo Type
        Route::resource('cargo-types', '\App\Http\Controllers\Admin\CargoTypeController');
    
        // User Info
        Route::delete('user-infos/destroy', 'UserInfoController@massDestroy')->name('user-infos.massDestroy');
        Route::resource('user-infos', 'UserInfoController');
    
        // Port
        Route::delete('ports/destroy', 'PortController@massDestroy')->name('ports.massDestroy');
        Route::resource('ports', '\App\Http\Controllers\Admin\PortController');
    
        // Vessel
        Route::delete('vessels/destroy', 'VesselController@massDestroy')->name('vessels.massDestroy');
        Route::post('vessels/media', 'VesselController@storeMedia')->name('vessels.storeMedia');
        Route::post('vessels/ckmedia', 'VesselController@storeCKEditorImages')->name('vessels.storeCKEditorImages');
        Route::resource('vessels', '\App\Http\Controllers\Admin\VesselController');
    
        // Cargo
        Route::delete('cargos/destroy',[\App\Http\Controllers\Admin\CargoController::class, 'massDestroy'])->name('cargos.massDestroy');
        Route::resource('cargos', '\App\Http\Controllers\Admin\CargoController');
    
        // Payment
        Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
        Route::resource('payments', 'PaymentController');
        Route::get('send_pay', 'PaymentController@send_pay')->name('send_pay');
        
    
        // Shipment
        Route::delete('shipments/destroy', 'ShipmentController@massDestroy')->name('shipments.massDestroy');
        Route::resource('shipments', 'ShipmentController');
    
        // Negotiation
        Route::delete('negotiations/destroy', 'NegotiationController@massDestroy')->name('negotiations.massDestroy');
        Route::resource('negotiations', 'NegotiationController');
        
        // Done Negotiation
        Route::delete('done-negotiations/destroy', 'DoneNegotiationController@massDestroy')->name('done-negotiations.massDestroy');
        Route::post('done-negotiations/media', 'DoneNegotiationController@storeMedia')->name('done-negotiations.storeMedia');
        Route::post('done-negotiations/ckmedia', 'DoneNegotiationController@storeCKEditorImages')->name('done-negotiations.storeCKEditorImages');
        Route::resource('done-negotiations', 'DoneNegotiationController');
        
        Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    
    
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
