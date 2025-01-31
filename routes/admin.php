<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;

Route::middleware(['auth', 'type:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{slug}', [ProductController::class, 'show'])->name('admin.products.show');

    // Sizes
    Route::get('/sizes', function(){
        return view('admin.sizes.index');
    })->name('admin.sizes.index');

    // Categories
    Route::get('/categories', function(){
        return view('admin.categories.index');
    })->name('admin.categories.index');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');

    // API Logs
    Route::get('/analytics', function(){
        return view('admin.api.index');
    })->name('admin.analytics.index');
});
