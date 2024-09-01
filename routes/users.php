<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'users'], function () {
    Route::patch('/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::get('/me', function () {
        return response()->json(auth()->user());
    });
});
