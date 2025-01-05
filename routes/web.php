<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CustomerController;

Route::get('/', [CustomerController::class, 'home'])->name('home');

Route::view('profile', 'customer.account')
    ->middleware(['auth'])
    ->name('profile');


Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('product/{slug}', [ProductController::class, 'show'])->name('product.show');



// Cart routes
Route::get('cart', function() {
    return view('customer.cart.index');
})->name('cart.show');

Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout');


Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->group(base_path('routes/admin.php'));

require __DIR__ . '/auth.php';
