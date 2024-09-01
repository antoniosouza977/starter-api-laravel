<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('/register',[ UsersController::class, 'store'])->name('register');
Route::post('/create-token',[ LoginController::class, 'login'])->name('login');
