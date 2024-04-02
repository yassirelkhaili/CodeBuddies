<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/login", [LoginController::class, 'index'])->name('login.index');

Route::get("/register", [RegisterController::class, 'index'])->name('register.index');
