<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CustomerController;

Route::get('/', [CustomerController::class, 'home'])->name('home');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::post('cart', [CartController::class, 'store'])->name('cart.store');
Route::get('cart', [CartController::class, 'show'])->name('cart.show');
Route::get('cart/add', [CartController::class, 'add'])->name('cart.add');




Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->group(base_path('routes/admin.php'));

require __DIR__ . '/auth.php';
