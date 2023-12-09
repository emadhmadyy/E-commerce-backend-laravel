<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCardsController extends Controller
{
    public function updateCartItemStatus()
    {
        // Retrieve and update cart items
        $this->items->each(function ($cartItem) {
            $cartItem->update(['cart_item_status' => 'completed']);
        });
    }
}
