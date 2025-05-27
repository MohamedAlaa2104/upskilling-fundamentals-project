<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;

class CartController extends Controller
{

    public function getCart()
    {
        $user = auth()->user();

        $cart = $user->cart()->firstOrCreate();

        $cartItems = $cart->cartItems;

        return CartResource::make($cart);
    }

    public function addCartItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);


        $user = auth()->user();

        $cart = $user->cart()->firstOrCreate();

        $cartItem = $cart->cartItems()->firstOrCreate(
            [
            'product_id' => $request->product_id,
        ],[
            'user_id' => $user->id,
            'quantity' => $request->quantity,
        ]);


        // $cartItem = $cart->cartItems()->create([
        //     'user_id' => $user->id,
        //     'product_id' => $request->product_id,
        //     'quantity' => $request->quantity,
        // ]);

        return response()->json([
            'success' => true,
            'message' => 'Cart item added successfully',
            'cart_item' => CartItemResource::make($cartItem),
        ], 200);
    }
}
