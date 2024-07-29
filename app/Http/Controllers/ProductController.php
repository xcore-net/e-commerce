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

      
        // تحقق من صحة الطلب
        $request->validate([
            'title' => ['required', 'string'],
            'desc' => ['required', 'string'],
            'amount' => ['required', 'integer'],
            'img' => ['required'], // تحقق من صحة الصورة
            'price' => ['required', 'integer'],
            'category' => ['required', 'in:clothes,food'],
        ]);

        $path = $request->file('img')->store('image3','public');
            // $file = $request->file('img');
            // $extention= $file->getClientOriginalExtension();
            // $filename= time().'.'.$extention;
            // $path='images/products/';
            // $file->move($path,$filename);
       
            // dd($request->img);
        // إنشاء المنتج
        $product = Product::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'amount' => $request->amount,
            'img' => $path, // استخدم المسار الكامل للصورة
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return redirect()->route('product.index'); // إعادة التوجيه بعد التخزين
    }
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.create', ['product' => $product]);
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
     
            
             
             return redirect()->route('product.index'); 
            }

     public function destroy($product_id)
     { 
        
        $product=Product::where('id',$product_id)->first();

         $product->delete();
       
         return redirect()->route('product.index');

     }

    //  public function show (Request $request,$product_id) {
    //     $products=Product::where('id',$product_id)->first();
    //     return view('product.show',['products'=>$products]);
    // }

    
    public function show($product_id) {
        $product = Product::findOrFail($product_id); // Fetch the product by ID
        return view('product.show', compact('product')); // Pass the product to the view
    }





}
