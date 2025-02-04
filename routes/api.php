<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;


// * Auth routes
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');

// * User routes
Route::get('/user', [UserController::class, 'show'])->name('user.show')->middleware('auth:sanctum');

// * Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');


// * Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// * Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth:sanctum');
