<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index',['products'=>$products]);
    }
    public function create()
    {
        if (! Gate::allows('add-product')) {
            abort(403);
        }

        return view('product.create');
    }
    public function store(Request $request)
    {
       
        $request->validate([
        
        'title'=>['required','string'],
        'description'=>['required','string'],
        'price'=>['required','integer'],
        'image'=>['required','string'],
        'amount'=>['required','integer'],
        'category'=>['required','in:clothes,food']
        ]);

      
        $product = Product::create([
           
        'title'=>$request->title,
        'description'=> $request->description,
        'price'=> $request->price,
        'image'=> $request->image,
        'amount'=> $request->amount,
        'category'=> $request->category
        ]);
        

        return redirect()->route('product.index');
    }

    public function edit($product_id)
    {
        if (! Gate::allows('add-product')) {
            abort(403);
        }

        $product = Product::where('id',$product_id)->first();
        return view('product.create',['product'=>$product]);
    }

    public function update(Request $request , $product_id)
    {
        $product = Product::where('id',$product_id)->first();

        $request->validate([
        
        'title'=>['required','string'],
        'description'=>['required','string'],
        'price'=>['required','integer'],
        'image'=>['required','string'],
        'amount'=>['required','integer'],
        'category'=>['required','in:clothes,food']
        ]);


        $product->update([
           
        'title'=>$request->title,
        'description'=> $request->description,
        'price'=> $request->price,
        'image'=> $request->image,
        'amount'=> $request->amount,
        'category'=> $request->category
        ]);

        return redirect()->route('product.index');
    }

    public function show($product_id)
    {
        $product = Product::where('id',$product_id)->first();

        return view('product.show',['product'=>$product]);
    }

    public function destroy($product_id)
    {
        $product = Product::where('id',$product_id)->first();
        $product->delete();

        return redirect()->route('product.index');
    }



}
