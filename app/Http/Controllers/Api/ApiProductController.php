<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController 
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'products'=>$products
        ]);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $request = $data['products'];

        $product = Product::create([
           
        'title'=>$request['title'],
        'description'=> $request['description'],
        'price'=> $request['price'],
        'image'=> $request['image'],
        'amount'=> $request['amount'],
        'category'=> $request['category']
        ]);
        

        if($product){
            return response()->json([
                'status' => 'success',
                'message' => 'Data fetched successfully',
            ], 200);}
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Failed to store data'
                ], 500);
            }
        }

        public function update(Request $request , $product_id)
    {
        $product = Product::where('id',$product_id)->first();


        $data = $request->all();
        $request = $data['products'];

        $product->update([
           
        'title'=>$request['title'],
        'description'=> $request['description'],
        'price'=> $request['price'],
        'image'=> $request['image'],
        'amount'=> $request['amount'],
        'category'=> $request['category']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'product updated successfuly' 
    ],200);
    }

    public function show($product_id)
    {
        $product = Product::where('id',$product_id)->first();

            return response()->json([
                    'products'=>$product
        ]);    }
      
    public function destroy($product_id)
    {
        $product = Product::where('id',$product_id)->first();
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'product deleted successfuly' 
    ],200);
        }
}
