<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;


// auth routes

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', IsAdmin::class]], function(){
    Route::get('users', [App\Http\Controllers\UsersController::class, 'index']);

    Route::post('users', [App\Http\Controllers\UsersController::class, 'store']);

    Route::get('users/{id}', [App\Http\Controllers\UsersController::class, 'show']);

    Route::post('users/{user}/edit', [App\Http\Controllers\UsersController::class, 'update']);

    Route::delete('users/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);
});

