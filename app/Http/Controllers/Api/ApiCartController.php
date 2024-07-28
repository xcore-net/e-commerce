<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ApiCartController extends Controller
{
    public function getCart(): JsonResponse
    {
        $user = Auth::user();
        $carts = $user->carts;

        $cartsWithProducts = $carts->map(function ($cart) use ($user) {
            $product = $user->products->where('id', $cart->product_id)->first();
            if ($product) {
                $cart->title = $product->title;
                $cart->price = $product->price;
                $cart->category = $product->category;
                return $cart;
            }
            return null;
        });

        return response()->json($cartsWithProducts, 200);
    }
    public function addProductToCart(Request $request): JsonResponse
    {
        $user_carts = Cart::where('user_id', Auth::id())->get();

        $duplicate_product = $user_carts->where('product_id', $request->product_id)->first();

        if ($duplicate_product) {
            $duplicate_product->amount += $request->amount;
            $duplicate_product->save();
            return response()->Json('Product added to cart successfully!', 200);
        }

        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
        ]);

        return response()->json("Product added to cart successfully");
    }

    public function removeProductFromCart($id)
    {
        $user = Auth::user();
        $cart = $user->carts->find($id);
        Gate::authorize('delete', $cart); //useless
        $cart->delete();
        return response()->json('Product removed');
    }

    public function updateCartProduct($id, Request $request)
    {
        $user = Auth::user();
        $cart = $user->carts->find($id);
        $cart->update([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
        ]);
        return response()->json('Product updated');
    }

    public function clearCart(): JsonResponse
    {
        $user = Auth::user();
        $carts = $user->carts;

        foreach ($carts as $cart) {
            $cart->delete();
        }
        return response()->json('Cart cleared');
    }

    public function checkout(): JsonResponse
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
            'user_id' => $user->id,
            'total_price' => $totalPrice,
        ]);

        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $order->products->attach($cart->product_id, [
                'amount' => $cart->amount,
                'price' => $product->price,
            ]);
        }

        // Empty the user's cart
        $this->clearCart();

        return response()->json('Order placed successfully!', 200);
    }
}
