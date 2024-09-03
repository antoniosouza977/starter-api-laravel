<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::get('/me', [UsersController::class, 'me'])->name('users.me');
    Route::patch('/update/{id}', [UsersController::class, 'update'])->name('users.update');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/show/{id}', [UsersController::class, 'show'])->name('users.show');
        Route::delete('/delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');
    });
});
