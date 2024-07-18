<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();

        return view('product.index',['products'=>$products]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
       
        // dd($request->title);

        $request->validate([
            'title' => ['required','string',],
            'desc' => ['required','string'],
            'amount' => ['required', 'integer']  ,
            'img'=> ['required','string'],
            'price'=> ['required','integer'],
            'category'=> ['required','in:clothes,food']

        ]);

        $product = Product::create([
            'title'=>$request->title,
            'desc' => $request->desc,
            'amount' => $request->amount,
            'img' => $request->img,
            'price' => $request->price,
            'category' => $request->category,
        ]);        
 
      
        
        
        
        return redirect()->route('product.index'); // Corrected the redirect method
     }

     public function edit($product_id)
     {
        $product=Product::where('id',$product_id)->first();
         return view('product.create',['product'=>$product]);
     }

     public function update(Request $request,$product_id)
     {
        
        $request->validate([
        'title' => ['required','string',],
        'desc' => ['required','string'],
        'amount' => ['required', 'integer']  ,
        'img'=> ['required','string',],
        'price'=> ['required','integer'],
        'category'=> ['required','string','in:clothes,food']
        ]);
 
        $product=Product::where('id',$product_id)->first();

         $product->update([
            'title'=>$request->title,
            'desc' => $request->desc,
            'amount' => $request->amount,
            'img' => $request->img,
            'price' => $request->price,
            'category' => $request->category,
         ]);
 
        
         
         return redirect()->route('product.index'); // Corrected the redirect method
     }
 

     public function destroy($product_id)
     { 
        
        $product=Product::where('id',$product_id)->first();

         $product->delete();
       
         return redirect()->route('product.index');

     }






}
