<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/list', [App\Http\Controllers\Api\ProductController::class, 'productList'])->name('products.list');
Route::get('/cart/list', [App\Http\Controllers\Api\CartController::class, 'cartList'])->name('cart.list');
Route::post('/cart/store', [App\Http\Controllers\Api\CartController::class, 'addToCart'])->name('cart.store');
Route::post('/checkout/store', [App\Http\Controllers\Api\CheckoutController::class, 'processToCheckout'])->name('checkout.store');
Route::get('/order/list', [App\Http\Controllers\Api\CheckoutController::class, 'getOrder'])->name('order.list');


