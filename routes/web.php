<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::prefix('/')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('homepage');
});

Route::prefix('admin')->middleware('auth')->group(function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');

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

    ]);

    Route::get('/ajax-product', [HelperController::class, 'getProductDetails'])->name('ajax-product');

    Route::get('/ajax-stock', [HelperController::class, 'getStockDetails'])->name('ajax-stock');
});
