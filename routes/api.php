<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Models\User;
use App\Models\Cart;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;

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

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('cart', [App\Http\Controllers\CartController::class, 'getCart']);
    Route::post('cart/cart-item', [App\Http\Controllers\CartController::class, 'addCartItem']);
    //Update cart item
    //Delete cart item
});


// Process to checkout
//Order Creation 

//DB Tables
/*


Orders table
id
user_id
total_cost
status => pending, completed, cancelled

Order Items table
 id
 order_id
 product_id
 quantity
 price => product price


 Extra 
 Validation on product quantity
 



*/



// Route::get('test', function(){
    // $user = User::find(4);

    // $res = $user->cartRelation()->create();

    // $user = User::find(4);
    //$user->cart()->exists();  //true or false

    // $user->cart()->first();

    // if($user->cart()->exists()){}

    // $cart = $user->cart()->firstOrCreate();

    // dd($res );

    // $cart = Cart::find(1);

    // dd($cart->user);


    // $user = User::find(4);

    // $cart = $user->cart()->firstOrCreate();

    // $cartItem = $cart->cartItems()->create([
    //     'user_id' => $user->id,
    //     'product_id' => 1,
    //     'quantity' => 3,
    // ]);

    // $cartItems = CartItem::all();

    // return CartItemResource::make($cartItem);


    // return CartItemResource::collection($cartItems);
// });


/*

 User -> Add many products to cart
 Product -> Available to all users

 User -> has one cart
 Cart -> belongs to one user

 Cart -> has many products
 Products -> belongs to many carts


 Cart as a table
  id
  user_id
  product_id

  id user_id product_id
  1    2        5
  2    2        6
*/

