<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'is_available',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
