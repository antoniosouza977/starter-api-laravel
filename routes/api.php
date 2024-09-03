<?php

use App\Services\RouteService;
use Illuminate\Support\Facades\Route;

$routeService = new RouteService(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'appends');

Route::group(['prefix' => 'v1'], function () use ($routeService) {
    Route::get('/up', function () { return 'up';});
    $routeService->importRoutes('auth');

    Route::group(['middleware' => 'auth:sanctum'], function () use ($routeService) {
        $routeService->importRoutes('users');
    });
});

