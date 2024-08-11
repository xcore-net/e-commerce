<?php

namespace App\Http\Controllers;

use App\Events\lowOfStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\StoreProduct;
use App\Models\Store;



class CartController extends Controller
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
        // $product = $user->product->where('id', $cart->product_id)->get(); // Updated line

        return view('cart.index', ['products' => $cartsWithProducts]);
    }

    public function destroy($cart_id)
    {

        DB::table('carts')->where('id', $cart_id)->delete();
        return redirect()->route('cart.index');
    }


    public function add($product_id, Request $request)
    {
        lowOfStock::dispatch('low of stock');
        
        $storeProduct = StoreProduct::where('product_id', $product_id)->first();
        $amount = $request->input('amount');
        //  dd($product_id);
        //  dd($request) ;
        $user = Auth::user();
        $carts = $user->carts;
        $cart = $carts->where('product_id', $product_id)->first();

        // dd($cart);
        if ($cart) {

            $cart->amount += $amount;
            $cart->save();
            $storeProduct->quantity = $storeProduct->quantity - $amount; // طرح المبلغ من المنتج
            $storeProduct->quantity <=0 ? $storeProduct->status="outOfStock":( $storeProduct->quantity > $storeProduct->limit ?  $storeProduct->status= " inStock" :$storeProduct->status = "lowStock");
            $storeProduct->save();

           
        } else {

            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->product_id = $product_id;
            $cart->amount = $amount;
            $cart->save();
            $storeProduct->quantity = $storeProduct->quantity - $cart->amount; // طرح المبلغ من المنتج
            $storeProduct->save();

        }

    
     
    // Assuming you have a ProductManagerNotification class
    // $productManager = User::where('role', 'product_manager')->first(); // Adjust role as necessary
    // if ($productManager) {
    //     $productManager->notify(new notifications($storeProduct));
    

   
    // }


        return redirect(route('cart.index'));
    }


    // public function add(Request $request){
//     $product_id = $request->input('product_id');
//     $user_id = Auth::id(); 
//     $amount = $request->input('amount');

    //     $cart = Cart::where('user_id', $user_id)
//                 ->where('product_id', $product_id)
//                 ->first();
//     if($cart)
//     {
//         $cart->update([
//             'amount'=> $cart->amount + $amount
//         ]);
//     }
//     else
//     {
//     $cart = new Cart;
//     $cart->user_id = $user_id;
//     $cart->product_id = $product_id;
//     $cart->amount = $amount;

    //     }       
//     $cart->save(); 

    //     return redirect(route('welcome'));
// }
}
