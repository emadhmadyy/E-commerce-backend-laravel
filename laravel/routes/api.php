<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingCardsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/insert-product', [ProductsController::class, 'insertProduct']);
Route::get('/get-products', [ProductsController::class, 'getAllSellerProducts']);
Route::post('/update-product', [ProductsController::class, 'updateProduct']);
Route::post('/delete-product', [ProductsController::class, 'deleteProduct']);

Route::post('/add-to-cart', [ShoppingCardsController::class, 'addToCart']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register',[AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
});
