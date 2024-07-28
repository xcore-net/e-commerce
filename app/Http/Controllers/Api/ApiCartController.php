<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiCartController extends Controller
{
    public function index($user_id)
    {
        $user = User::where('id',$user_id)->first();
        $products = $user->product()->withPivot('amount','id')->where('user_id', $user->id)->get(); // Updated line

        return response()->json(['products'=>$products]);
    }

    public function destroy($cart_id)
    {
        DB::table('carts')->where('id', $cart_id)->delete(); 
        return response()->json([
            'message' => 'cart deleted successfully'
        ]);
    }

    public function add(Request $request){

        // $data = $request->all();
        // $request = $data['products'];
        // $pivot = $request['pivot'];
        
        $product_id = $request->product_id;
        $user_id = $request->user_id; 
        $amount = $request->amount; 

        

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

        return response()->json([
            'message' => 'cart saved seccessefully'
        ]);
    }
}
