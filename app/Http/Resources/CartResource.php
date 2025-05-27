<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'cart_items' => CartItemResource::collection($this->cartItems),
            'total_cost' => $this->cartItems->sum(function($item){
                return $item->product->price * $item->quantity;
            }),
            // 'total_cost' => $this->cartItems()->sum('quantity'),
            'total_items' => $this->cartItems->count(),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
