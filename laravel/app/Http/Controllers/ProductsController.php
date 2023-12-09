<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_detail;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function insert_product(Request $req)
    {
        $productData = [
            "product_name" => $req->product_name,
            "price" => $req->price,
            "seller_id" => $req->seller_id,
        ];
        $productDetailsData = [
            "description" => $req->description,
            "stock_quantity"=>$req->stock_quantity,
        ];
        try{
            $product1 = Product::create($productData);
            $productDetailsData['product_id'] = $product1->id;
            $product_detail = Product_detail::create($productDetailsData);
            return response()->json(['message' => 'Product and details added successfully'], 201);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Failed to add product and details'], 500);
        }
        
    }
}
