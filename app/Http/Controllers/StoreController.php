<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('main', ['products' => $products]);
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $user_carts = Cart::where('user_id', Auth::id())->get();

        $duplicate_product = $user_carts->where('product_id', $request->product_id)->first();

        if ($duplicate_product) {
            $duplicate_product->amount += $request->amount;
            $duplicate_product->save();
            return redirect()->route('store')->with('success', 'Product added to cart successfully!');
        }

        $cartController = new CartController();
        return $cartController->store($request);
    }

    public function checkout(): RedirectResponse
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('store')->with('error', 'Your cart is empty.');
        }
        
        $totalPrice = $carts->sum(function ($cart) {
            $product = Product::find($cart->product_id);
            return $cart->amount * $product->price;
        });

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $order->products()->attach($cart->product_id, [
                'amount' => $cart->amount,
                'price' => $product->price,
            ]);
        }

        // Empty the user's cart
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('store')->with('success', 'Order placed successfully!');
    }
}
