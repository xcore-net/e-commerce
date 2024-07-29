<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;


class ApiCartController extends Controller
{
public function index()
{

    $user = User::where('id', Auth::user()->id)->first();
    $carts = $user->carts;

    $cartsWithProducts = $carts->map(function ($cart) use ($user) {
        $product = $user->product->where('id', $cart->product_id)->first();
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
    // $products = $user->product->where('id', $cart->product_id)->get(); // Updated line

    return response()->json(['products' => $cartsWithProducts]);
}

public function destroy($cart_id)
{

    DB::table('carts')->where('id', $cart_id)->delete();
    return response()->json(['message'=>'deleted succesfuly']);}


public function add($product_id, Request $request)
{

    $amount = $request->input('amount');
    //  dd($product_id);
    //  dd($request) ;
    $user = Auth::user();
    $carts = $user->carts;
    // $products = $user->product()->where('product_id', $product_id)->first();

    $cart = $carts->where('product_id', $product_id)->first();

    // dd($cart);
    if ($cart) {

        $cart->amount += $amount;
        $cart->save();
    } else {

        $cart = new Cart;
        $cart->user_id = $user->id;
        $cart->product_id = $product_id;
        $cart->amount = $amount;
        $cart->save();

    }

    return response()->json(['message'=>'add product succesfuly']);
}





}
