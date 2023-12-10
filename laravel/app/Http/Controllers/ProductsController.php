<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function insertProduct(Request $req)
    {
        $user = Auth::user();
        try{
            $user->id!=null;
        }
        catch(\Exception $e){
            return response()->json(['message'=> 'UnAuthorized']);
        }
        if($user->usertype_id == 1){
            $productData = [
                "product_name" => $req->product_name,
                "price" => $req->price,
                "seller_id" => $user->id,
            ];
            $productDetailsData = [
                "description" => $req->description,
                "stock_quantity"=>$req->stock_quantity,
            ];
            try{
                $product = Product::create($productData);
                $productDetailsData['product_id'] = $product->id;
                $product_detail = Product_detail::create($productDetailsData);
                return response()->json(['message' => 'Product and details added successfully'], 201);
            }
            catch (\Exception $e) {
                return response()->json(['message' => 'Failed to add product and details'.$e], 500);
            }
        }else{
            return response()->json(['message'=>'UnAuthorized']);
        }
    }

    public function getAllSellerProducts(){ 
        $user = Auth::user();
        try{
            $user->id!=null;
        }
        catch(\Exception $e){
            return response()->json(['message'=> 'UnAuthorized']);
        }
        if($user->usertype_id == 1){
            $products = Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->where('products.seller_id', $user->id)
            ->select('products.*', 'product_details.*')
            ->get();
            return response()->json($products);
        }
    }
        

    public function updateProduct(Request $req){
        $user = Auth::user();
        try {
            $user->id != null;
        } 
        catch (\Exception $e) {
            return response()->json(['message' => 'UnAuthorized']);
        }
        if($user->usertype_id==1){
            $updatedProductData = [
                "product_name" => $req->product_name,
                "price" => $req->price,
                "seller_id" => $user->id,
            ];
            $updatedProductDetailData = [
                "description" => $req->description,
                "stock_quantity" => $req->stock_quantity,
            ];

            try {
                $product = Product::find($req->product_id);
                $product->update($updatedProductData);
                Product_detail::where('product_id', $product->id)->update($updatedProductDetailData);
                return response()->json(['message'=>'Updated Successfully']);
            } 
            catch (\Exception $e) {
                return response()->json(['message' => 'Data not updated']);
            }
        }
    }

    public function deleteProduct(Request $req){
        $user = Auth::user();

        try {
            $user->id != null;
        } catch (\Exception $e) {
            return response()->json(['message' => 'UnAuthorized']);
        }

        try {
            $product = Product::find($req->product_id);
            if ($product->seller_id != $user->id) {
                return response()->json(['message' => 'UnAuthorized']);
            }
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);
        } 
        catch (\Exception $e) {
            return response()->json(['message' => 'Unsuccessful!']);
        }
    }

}
