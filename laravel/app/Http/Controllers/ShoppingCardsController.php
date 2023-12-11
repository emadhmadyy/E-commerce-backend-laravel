<?php

namespace App\Http\Controllers;

use App\Models\Shopping_cart;
use App\Models\Cart_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCardsController extends Controller
{
    public function addToCart(Request $req){
        $user = Auth::user();
        try{
            $user->id!=null;
        }
        catch(\Exception $e){
            return response()->json(['message'=> 'UnAuthorized']);
        }
        try {
            $shoppingCartData = Shopping_cart::where('user_id', $user->id)->firstOrFail();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Shopping cart doesnt exist'], 404);
        }
        if($shoppingCartData->id == $req->shopping_cart_id){
            $cartData = [
                "shopping_cart_id" => $req->shopping_cart_id,
                "product_id" => $req->product_id,
            ];
            try{
                $cart_item = Cart_item::create($cartData);
                return response()->json(['message' => 'item added successfully'], 201);
            }
            catch (\Exception $e) {
                return response()->json(['message' => 'Failed to add item'.$e], 500);
            }
        }else{
            return response()->json(['message'=>'shopping card doesnt belong to this user']);
        }
    }
}
