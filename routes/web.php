<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Index Routes

Route::get('/', function () {
    return view('welcome');
});
Route::get("/login", [LoginController::class, 'index'])->name('login.index');
Route::get("/register", [RegisterController::class, 'index'])->name('register.index');

// Auth Routes

Route::post("/login", [LoginController::class, 'login'])->name('login.authanticate');

