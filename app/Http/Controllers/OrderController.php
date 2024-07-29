<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // Add this line
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Cart;
class OrderController extends Controller
{
  public function index(){
    $orders = Order::with('product')->get();

    return view('order.index',['orders'=>$orders]);
}

public function add()
{
    $user_id = Auth::user()->id;
    $carts = Cart::where('user_id', $user_id)->get();

    // Check if the cart is empty
    if ($carts->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }
    
    $order = new Order;
    $order->user_id = $user_id;

    $total = 0;
    foreach($carts as $cart)
    {
        $product = Product::where('id',$cart->product_id)->first();
        $amount = $cart->amount;
        $total += $product->price * $amount;
    
    }

    $order->total = $total;
    $order->created_at = Carbon::now();
    $order->save();

    foreach($carts as $cart)
    {
        $order_product = new OrderProduct;
        $order_product->order_id = $order->id;
        $order_product->product_id = $cart->product_id;
        $order_product->amount = $cart->amount;
        $order_product->save();
        $cart->delete();
    }

    
    return redirect(route('order.index'));
}
}