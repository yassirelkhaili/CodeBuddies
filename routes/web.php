<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForumController;

// Index Routes
Route::get('/', [mainController::class, 'indexHome'])->name('home.index');
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
// Auth Routes
Route::get('register', [AuthController::class, 'indexRegisterPage'])->middleware(AuthMiddleware::class)->name('register.index');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'indexLoginPage'])->middleware(AuthMiddleware::class)->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class)->name('logout');

Route::get('/forget-password', [AuthController::class, 'indexForgetPasswordForm'])->name('forget-password.index');
Route::post('/forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget-password');

Route::get('/reset-password/{token}', [AuthController::class, 'indexResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset-password');
Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('password.update');

Route::get('/user/{id}/settings', [UserController::class, 'show'])->name('user.settings');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/verify-email', [EmailVerificationController::class, 'store'])
        ->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::get('/email/verification-notification', [EmailVerificationController::class, 'prompt'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});
