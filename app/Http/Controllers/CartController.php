<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $user = User::where('id',Auth::user()->id)->first();
        $products = $user->product()->withPivot('amount','id')->where('user_id', $user->id)->get(); // Updated line

        return view('cart.index',['products'=>$products]);
    }

    public function destroy($cart_id)
    {
        DB::table('carts')->where('id', $cart_id)->delete(); 
        return redirect()->route('cart.index');
    }
    public function add(Request $request){
        $product_id = $request->input('product_id');
        $user_id = Auth::id(); 
        $amount = $request->input('amount');

        $cart = Cart::where('user_id', $user_id)
                    ->where('product_id', $product_id)
                    ->first();
        if($cart)
        {
            $cart->update([
                'amount'=> $cart->amount + $amount
            ]);
        }
        else
        {
        $cart = new Cart;
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->amount = $amount;
      
        }       
        $cart->save(); 

        return redirect(route('welcome'));
    }
}
