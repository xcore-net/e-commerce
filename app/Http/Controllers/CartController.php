<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
            } else {
                // Handle the case where the product is not found
                $cart->title = 'Unknown Product';
                $cart->price = 0;
                $cart->category = 'Unknown';
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
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'desc' => ['required', 'string'],
        //     'price' => ['required', 'integer'],
        //     'amount' => ['required', 'integer', 'digits:6'],
        //     'category' => ['required', 'string'],
        //     'img' => ['required', 'string'],
        // ]);

        $cart = Cart::create([
            'user_id' => Auth::user()->id,
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
            'img' => ['required', 'string'],
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
}
