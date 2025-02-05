<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\CustomerController;
use App\Http\Controllers\Back\HelperController;
use App\Http\Controllers\Back\HomeController;
use App\Http\Controllers\Back\ModelController;
use App\Http\Controllers\Back\PermissionController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\StockInController;
use App\Http\Controllers\Back\StockOutController;
use App\Http\Controllers\Back\SupplierController;
use App\Http\Controllers\Back\UnitController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\WarehouseController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Front\FrontProductController;
use App\Http\Controllers\Front\FrontProductImageController;
use App\Http\Controllers\Front\FrontSettingController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('email/verify/{token}', [RegisterController::class, 'verifyEmail'])->name('verifyEmail');
Route::post('resendVerificationEmail', [VerificationController::class, 'resendVerificationEmail'])->name('resendVerificationEmail');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::prefix('/')->group(function () {
    Route::get('/', [FrontHomeController::class, 'index'])->name('homepage');

    Route::resources([
        'settings' => FrontSettingController::class,
    ]);

});

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/rate-limited-users', [UserController::class, 'showRateLimitedUsers'])->name('rate.limited.users');
    Route::post('/rate-clear-users', [UserController::class, 'clearRateLimitedUsers'])->name('rate.clear.users');

    Route::get('/roles/{role}/users', [UserController::class, 'manageRoles'])->name('user.roles');
    Route::post('/roles/{role}/users', [UserController::class, 'updateRoles'])->name('user.update.roles');


    Route::get('/roles/{role}/permissions', [RoleController::class, 'managePermissions'])->name('roles.permissions');
    Route::post('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');


    Route::post('/isActive/{id}/users', [UserController::class, 'isActiveSetter'])->name('user.is-active-setter');
    Route::post('/isActive/{id}/product', [FrontProductController::class, 'isActiveSetter'])->name('ajax.is-active-setter');
    Route::post('/ajax-rankSetter', [FrontProductController::class, 'rankSetter'])->name('ajax-rankSetter');

    Route::get('/image-form/{id}/product', [FrontProductController::class, 'product_image'])->name('product.image-form');

    Route::post('/image-upload/{id}/product', [FrontProductController::class, 'product_image_upload'])->name('product.image-upload');

    Route::post('/image-refresh/{id}/product', [FrontProductController::class, 'product_refresh_image'])->name('product.refresh-image-list');


    Route::post('/isActive/{id}/product-image', [FrontProductImageController::class, 'isActiveSetter'])->name('ajax.is-active-setter-product-image');

    Route::post('/ajax-rankSetter-product-image', [FrontProductImageController::class, 'rankSetter'])->name('ajax-rankSetter-product-image');

    Route::post('/isCoverSetter/{id}/{parent}/product-image', [FrontProductImageController::class, 'isCoverSetter'])->name('isCoverSetter-product-image');


    Route::resources([
        'stock-in' => StockInController::class,
        'stock-out' => StockOutController::class,
        'categories' => CategoryController::class,
        'models' => ModelController::class,
        'products' => ProductController::class,
        'warehouse' => WarehouseController::class,
        'units' => UnitController::class,
        'customers' => CustomerController::class,
        'suppliers' => SupplierController::class,
        'permissions' => PermissionController::class,
        'users' => UserController::class,
        'roles' => RoleController::class,
        'product' => FrontProductController::class,
        'product-image' => FrontProductImageController::class,

    ]);

    Route::get('/ajax-product', [HelperController::class, 'getProductDetails'])->name('ajax-product');

    Route::get('/ajax-stock', [HelperController::class, 'getStockDetails'])->name('ajax-stock');


});
