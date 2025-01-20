<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

// Route untuk login
Route::get('/login', [CustomAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomAuthController::class, 'login']);

// Route untuk register
Route::get('/register', [CustomAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [CustomAuthController::class, 'register']);

// Route untuk logout
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');
