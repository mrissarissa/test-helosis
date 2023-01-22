<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use DB;
class CheckoutController extends Controller
{
    public function processToCheckout(Request $request){
        DB::beginTransaction();
        try {
            $check_cust = User::where('email', $request->email)->first();

            if(!$check_cust){
                return response()->json([
                    'success' => false,
                    'notif' => "Silahkan Login terlebih dahulu"
                ], 404);;

            }else{
                $getCart = Cart::where('user_id', $check_cust->id)->get();

                $total = collect($getCart)->sum(function($q){
                    return $q['quantity'] * $q['price'];
                });
                // $total = 0;
                // foreach ($getCart as $key => $cart) {
                //     $total += $cart['quantity'] * $cart['price'];
                // }


                $customer = Customer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone_number' =>$request->phone_number,
                    'address' => $request->address,
                    'city' => $request->city,

                ]);


                $order = Order::create([
                    'invoice' => Str::random(4).'-'.time(),
                    'customer_id' => $customer->id,
                    'sub_total' => $total,
                    'status_paid' => 'belum_bayar',
                    'status_shipment'=>'belum_dikirim'
                ]);

                foreach ($getCart as $key => $cart) {
                    OrderDetail::create([
                        'order_id'=>$order->id,
                        'product_id' => $cart->id,
                        'qty' => $cart->quantity,
                        'price' => $cart->price,

                    ]);
                }
                $updatedCart = Cart::where('user_id', $check_cust->id)->update([
                    'status' => 1
                ]);
                DB::commit();
                return response()->json([
                    'success' => true,
                    'notif' => "Berhasil di checkout"
                ], 200);

            }

        } catch (\Throwable $th) {
             DB::rollback();
             return response()->json([
                    'success' => false,
                    'notif' => $th->getMessage()
                ], 404);;
        }
    }

    public function getOrder(Request $request){

        $orderlist = Order::where('customer_id', $request->customer_id)->get();
        $orderdetail = Order::where('customer_id', $request->customer_id)
                        ->leftjoin('order_details','orders.id','=','order_details.order_id')
                        ->select('order_details.*')->get();
        return response()->json([
            'success' => true,
            'data'=> [
                'order' => $orderlist,
                'order_detail' => $orderdetail
            ]
        ], 200);
    }
}
