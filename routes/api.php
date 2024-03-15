<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', App\Http\Controllers\API\v1\AuthApi\RegisterApiController::class)->name('register');
    Route::post('/login', App\Http\Controllers\API\v1\AuthApi\LoginApiController::class)->name('login');
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', App\Http\Controllers\API\v1\AuthApi\LogoutApiController::class)->name('logout');
    Route::put('/user/edit', App\Http\Controllers\API\v1\AuthApi\EditApiController::class)->name('user.edit');
});