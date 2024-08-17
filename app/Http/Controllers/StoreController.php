<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Notifications\AlertNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $store = Store::first();
        $products = $store->products;
        return view('store', ['products' => $products]);
    }
    public function getStores(): View
    {
        $stores = Store::all();
        return view('store.index', ['stores' => $stores]);
    }
    public function create(): View
    {
        return view('store.create');
    }
    public function store(Request $request)
    {
        Store::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);
    }
    public function show($id)
    {
        $store = Store::find($id);
        $products = Product::all();

        return view('store.show', ['store' => $store, 'storeProducts' => $store->products, 'products' => $products]);
    }
    public function addProduct($id, Request $request)
    {
        $store = Store::find($id);
        $product_id = $request->product_id;

        $store->products()->attach($product_id, [
            'quantity' => $request->quantity,
            'limit' => $request->limit,
            'price' => $request->price,
            'status' => $request->quantity > $request->limit ? 'InStock' : 'LowStock'
        ]);
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

                if ($status == 'LowStock' || $status == 'OutOfStock') {
                    $users = User::role('productManager')->get();

                    $productCollection = collect([
                        'product' => $storeProduct,
                        // 'status' => $storeProduct->pivot->status,
                        // 'quantity' => $storeProduct->pivot->quantity,
                        // 'store_id' => $storeProduct->pivot->store_id,
                    ]);

                    foreach ($users as $user) {
                        $user->notify(new AlertNotification($productCollection));
                    }
                }

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
