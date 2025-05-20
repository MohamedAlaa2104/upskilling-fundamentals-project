<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::view('/', 'welcome');

//Route::get('/users', function (){
//    $reqObj = request();

//    $name = $reqObj->name;
//    $email = $reqObj->email;
//    $password = $reqObj->password;
//    $role = $reqObj->role;


//    $user = new User();
//    $user->name = $name;
//    $user->email = $email;
//    $user->password = $password;
//    $user->role = $role;
//
//    $user->save();
//    $user = User::create([
//        'name' => $name,
//        'email' => $email,
//        'password' => $password,
//        'role' => $role
//    ]);

//    $user = User::create(request()->all());
//
//    dd($user);
//
//});

//Route::post('/users', [App\Http\Controllers\UsersController::class, 'saveUserToDatabase']);