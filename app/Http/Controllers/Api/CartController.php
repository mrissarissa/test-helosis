<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = Cart::all();
        // dd($cartItems);
        return response()->json([
            'success' => true,
            'data'=> $cartItems
        ], 200);
    }


    public function addToCart(Request $request)
    {
        Cart::create([
            'id' => $request->id,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'success' => true,
            'notif' => "Berhasil menambah keranjang"
        ], 200);
    }

}
