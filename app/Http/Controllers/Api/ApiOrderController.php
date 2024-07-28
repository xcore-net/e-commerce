<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->get();

        return response()->json(['orders'=>$orders]);

    }

    public function add($user_id)
    {
        $carts = Cart::where('user_id', $user_id)->get();
        
        
        $order = new Order;
        $order->user_id = $user_id;

        $total_price = 0;
        foreach($carts as $cart)
        {
            $product = Product::where('id',$cart->product_id)->first();
            $amount = $cart->amount;
            $total_price += $product->price * $amount;
        
        }

        $order->total_price = $total_price;
        $order->created_at = Carbon::now();
        $order->save();

        foreach($carts as $cart)
        {
            $order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->product_id = $cart->product_id;
            $order_product->amount = $cart->amount;
            $order_product->save();
            $cart->delete();
        }

        

        
        return response()->json(['message'=>"order added successfully"]);
        
        
    }
}
