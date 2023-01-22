<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function productList()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'data'=> $products
        ], 200);
    }
}
