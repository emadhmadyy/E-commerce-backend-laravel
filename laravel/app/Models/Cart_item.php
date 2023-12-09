<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    use HasFactory;
    public function shoppingCart()
    {
        return $this->belongsTo(Shopping_cart::class);
    }
}
