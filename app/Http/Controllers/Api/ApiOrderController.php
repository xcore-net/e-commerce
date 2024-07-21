<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{

    public function getOrders(): JsonResponse
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function getOrder($id): JsonResponse
    {
        $orders = Order::where('user_id', $id)->get();
        return response()->json($orders);
    }

    public function getUserOrders($id)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $orders = $user->orders->with('products')->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        return response()->json($orders, 200);
    }
    public function createOrder(): JsonResponse
    {

        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return response()->json('Your cart is empty.', 400);
        }

        $totalPrice = $carts->sum(function ($cart) {
            $product = Product::find($cart->product_id);
            return $cart->amount * $product->price;
        });

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $totalPrice,
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $order->products()->attach($cart->product_id, [
                'amount' => $cart->amount,
                'price' => $product->price,
            ]);
        }

        return response()->json("done");
    }
}
