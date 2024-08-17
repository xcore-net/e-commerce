<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Models\User;
use App\Notifications\AlertNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;


//Might delete this
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
}
