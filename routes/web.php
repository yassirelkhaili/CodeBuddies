<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\mainController;
use App\Http\Middleware\AuthMiddleware;

// Index Routes
Route::get('/', [mainController::class, 'indexHome'])->name('home.index');

// Auth Routes
Route::get('register', [AuthController::class, 'indexRegisterPage'])->middleware(AuthMiddleware::class)->name('register.index');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'indexLoginPage'])->middleware(AuthMiddleware::class)->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class)->name('logout');

Route::get('/forget-password', [AuthController::class, 'index'])->name('forget.password.get');
Route::post('/forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

Route::get('/reset-password/{token}', [AuthController::class, 'index'])->name('reset.password.get');
Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

