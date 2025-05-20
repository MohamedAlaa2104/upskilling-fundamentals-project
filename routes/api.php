<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('users', [App\Http\Controllers\UsersController::class, 'index']);

Route::post('users', [App\Http\Controllers\UsersController::class, 'store']);

Route::get('users/{id}', [App\Http\Controllers\UsersController::class, 'show']);

Route::post('users/{user}/edit', [App\Http\Controllers\UsersController::class, 'update']);

Route::delete('users/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);

include_once 'api2.php';
