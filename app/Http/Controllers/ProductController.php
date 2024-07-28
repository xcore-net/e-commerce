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
        $imageName = '';
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName(); // Custom name
                $destinationPath = public_path('images'); // Destination path in the public folder
                $file->move($destinationPath, $filename); // Move the file
            
                $imageName = 'images/' . $filename;
                
            }else{
                dd($request->image);
            }
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->with('error', 'An error occurred while uploading the image.');
        }
        $request->validate([
        
        'title'=>['required','string'],
        'description'=>['required','string'],
        'price'=>['required','integer'],
        'amount'=>['required','integer'],
        'category'=>['required','in:clothes,food']
        ]);

      
        $product = Product::create([
           
        'title'=>$request->title,
        'description'=> $request->description,
        'price'=> $request->price,
        'image'=> $imageName,
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
