<?php

use App\Http\Controllers\Customer\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/',[CustomerController::class, 'home'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
