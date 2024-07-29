<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ApiProductController extends Controller
{
//     public function index(){

//         $products = Product::all();

//         return response()->json(['products' => $products]);
//     }

    

//     public function store(Request $request)
//     {
       
//         // dd($request->title);

//         $request->validate([
//             'title' => ['required','string',],
//             'desc' => ['required','string'],
//             'amount' => ['required', 'integer']  ,
//             'img'=> ['required','string'],
//             'price'=> ['required','integer'],
//             'category'=> ['required','in:clothes,food']

//         ]);

//         $product = Product::create([
//             'title'=>$request->title,
//             'desc' => $request->desc,
//             'amount' => $request->amount,
//             'img' => $request->img,
//             'price' => $request->price,
//             'category' => $request->category,
//         ]);        
 
      
        
        
        
//         return response()->json(['message'=>'stored succesfuly']);
//      }

   

//      public function update(Request $request,$product_id)
//      {
//         $product=Product::where('id',$product_id)->first();

//         $request->validate([
//         'title' => ['required','string',],
//         'desc' => ['required','string'],
//         'amount' => ['required', 'integer']  ,
//         'img'=> ['required','string',],
//         'price'=> ['required','integer'],
//         'category'=> ['required','string','in:clothes,food']
//         ]);
 

//          $product->update([
//             'title'=>$request->title,
//             'desc' => $request->desc,
//             'amount' => $request->amount,
//             'img' => $request->img,
//             'price' => $request->price,
//             'category' => $request->category,
//          ]);
 
        
         
//          return response()->json(['message'=>'updated succesfuly']);
//         }
 

//      public function destroy($product_id)
//      { 
        
//         $product=Product::where('id',$product_id)->first();

//          $product->delete();
       
//          return response()->json(['message'=>'deleted succesfuly']);

//      }

//     //  public function show (Request $request,$product_id) {
//     //     $products=Product::where('id',$product_id)->first();
//     //     return view('product.show',['products'=>$products]);
//     // }
//     public function show($product_id) {
//         $product = Product::findOrFail($product_id); // Fetch the product by ID
//         return response()->json(['product' => $product]);
//     }





// }



    public function index(){

        $products = Product::all();

        return response()->json(['products' => $products]);
        }

    

    public function store(Request $request)
    {
       
        // dd($request->title);

        $request->validate([
            'title' => ['required','string',],
            'desc' => ['required','string'],
            'amount' => ['required', 'integer']  ,
            'img'=> ['required'],
            'price'=> ['required','integer'],
            'category'=> ['required','in:clothes,food']

        ]);

         $path = $request->file('img')->store('image3','public');

        // $file = $request->file('img');
        // $extention= $file->getClientOriginalExtension();
        // $filename= time().'.'.$extention;
        // $path=$file->path().$filename;
        // $file->move($path,$filename);

        $product = Product::create([
            'title'=>$request->title,
            'desc' => $request->desc,
            'amount' => $request->amount,
            'img' => $path,
            'price' => $request->price,
            'category' => $request->category,
        ]);        
 
      
        
        
        return response()->json(['message'=>'stored succesfuly']);
        // Corrected the redirect method
     }


     public function update(Request $request,$product_id)
     {
        $product=Product::where('id',$product_id)->first();

        $request->validate([
        'title' => ['required','string',],
        'desc' => ['required','string'],
        'amount' => ['required', 'integer']  ,
        'img'=> ['required'],
        'price'=> ['required','integer'],
        'category'=> ['required','string','in:clothes,food']
        ]);
 

        // $file = $request->file('img');
        // $extention= $file->getClientOriginalExtension();
        // $filename= time().'.'.$extention;
        // $path='images/products/';
        // $file->move($path,$filename);
        $path = $request->file('img')->store('image3','public');

         $product->update([
            'title'=>$request->title,
            'desc' => $request->desc,
            'amount' => $request->amount,
            'img' => $path,
            'price' => $request->price,
            'category' => $request->category,
         ]);
 
        
         return response()->json(['message'=>'updated succesfuly']);
     }
 

     public function destroy($product_id)
     { 
        
        $product=Product::where('id',$product_id)->first();

         $product->delete();
       
         return response()->json(['message'=>'deleted succesfuly']);

     }

    //  public function show (Request $request,$product_id) {
    //     $products=Product::where('id',$product_id)->first();
    //     return view('product.show',['products'=>$products]);
    // }

    
    public function show($product_id) {
        $product = Product::findOrFail($product_id); // Fetch the product by ID
        return response()->json(['product' => $product]); // Pass the product to the view
    }





}
