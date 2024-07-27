<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

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


    //show create page
    public function create(): View
    {
        return view('cart.create');
    }

    //store details
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'desc' => ['required', 'string'],
        //     'price' => ['required', 'integer'],
        //     'amount' => ['required', 'integer', 'digits:6'],
        // ]);

        $cart = Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
        ]);

        return redirect(route('cart.index', absolute: false));
    }

    public function edit($id): View
    {
        $cart = Cart::find($id);
        return view('cart.create', ['cart' => $cart]);
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
        $cart->delete();
        return redirect(route('cart.index', absolute: false));
    }

    public function addToCart(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user_carts = Cart::where('user_id', $user->id)->get();

        $duplicate_product = $user_carts->where('product_id', $request->product_id)->first();

        if ($duplicate_product) {
            $duplicate_product->amount += $request->amount;
            $duplicate_product->save();
            return redirect()->route('store')->with('success', 'Product added to cart successfully!');
        }

        $cartController = new CartController();
        return $cartController->store($request);
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
        $this->clearCart();

        return redirect()->route('store')->with('success', 'Order placed successfully!');
    }
}
