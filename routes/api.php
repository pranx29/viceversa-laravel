<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ProductController;


// * Auth routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

// * Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index')->middleware('auth:sanctum');

// * Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth:sanctum');