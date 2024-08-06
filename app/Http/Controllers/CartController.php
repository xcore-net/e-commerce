<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $carts = $user->carts;

        $cartsWithProducts = $carts->map(function ($cart) use ($user) {
            $product = $user->products->where('id', $cart->product_id)->first();
            if ($product) {
                $cart->title = $product->title;
                $cart->price = $product->price;
                $cart->category = $product->category;
            }
            return $cart;
        });
        return view('cart.index', ['cartsWithProducts' => $cartsWithProducts]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'desc' => ['required', 'string'],
        //     'price' => ['required', 'integer'],
        //     'amount' => ['required', 'integer', 'digits:6'],
        // ]);
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
        ]);

        return redirect(route('cart.index', absolute: false));
    }

    public function update($id, Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string'],
            'price' => ['required', 'in:visa,paypal'],
            'amount' => ['required', 'integer', 'digits:6'],
            'category' => ['required', 'string'],
        ]);

        $cart = Cart::find('id', $id);

        $cart->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'amount' => $request->amount,
            'category' => $request->category,
            'img' => $request->img,
        ]);

        return redirect(route('cart.index', absolute: false));
    }
    public function destroy($id): RedirectResponse
    {
        $cart = Cart::find($id);

        Gate::authorize('delete', $cart);
        $cart->delete();

        return redirect(route('cart.index', absolute: false));
    }
    public function addToCart(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user_carts = $user->carts;

        $duplicate_product = $user_carts->where('product_id', $request->product_id)->first();

        if ($duplicate_product) {
            $duplicate_product->amount += $request->amount;
            $duplicate_product->save();
            return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
        }

        return $this->store($request);
    }
    public function clearCart()
    {
        $user = Auth::user();
        $carts = $user->carts;

        foreach ($carts as $cart) {
            $cart->delete();
        }
        return;
    }

    public function checkout(): RedirectResponse
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        
        $store = Store::first();

        if ($carts->isEmpty()) {
            return redirect()->route('store.index')->with('error', 'Your cart is empty.');
        }

        foreach ($carts as $cart) {
            $product = $cart->product;
            $storeProduct = $store->products()->where('product_id', $product->id)->first();
    
            if ($storeProduct) {
                $currentQuantity = $storeProduct->pivot->quantity;
                if ($currentQuantity < $cart->amount) {
                    return redirect()->route('store.index')->with('error', 'Not enough quantity for product: ' . $product->title);
                }
            }
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
            $product = $cart->product;

            $order->products()->attach($cart->product_id, [
                'amount' => $cart->amount,
                'price' => $product->price,
            ]);

            $storeProduct = $store->products()->where('product_id', $product->id)->first();

            if ($storeProduct) {
                $newQuantity = $storeProduct->pivot->quantity - $cart->amount;
                $status = $newQuantity <= 0 ? 'OutOfStock' : ($newQuantity < 10 ? 'LowStock' : 'InStock');

                $store->products()->updateExistingPivot($product->id, [
                    'quantity' => $newQuantity,
                    'status' => $status,
                ]);
            }
        }
        // Empty the user's cart
        $this->clearCart();

        return redirect()->route('order.index')->with('success', 'Order placed successfully!');
    }
}