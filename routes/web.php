<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WarehouseController;

Route::prefix('admin')->group(function () {



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

    Route::get('/get-product-details', [StockInController::class, 'getProductDetails'])->name('get-product-details');
});
