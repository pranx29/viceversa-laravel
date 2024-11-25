<?php

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'home'])->name('home');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->group(base_path('routes/admin.php'));

require __DIR__ . '/auth.php';
