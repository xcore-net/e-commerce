<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
}
