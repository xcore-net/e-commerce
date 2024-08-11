<?php

namespace App\Http\Controllers;
use App\Models\StoreProduct;
use App\Models\Product;
use App\Models\Cart;



use Illuminate\Http\Request;

class StoreProductController extends Controller
{
   
    public function index(){

        $StoreProduct = StoreProduct::all();

        return view('storeproduct.index',['products'=>$StoreProduct]);
    }
    // public function create()
    // {
    //     return view('storeproduct.create');
    // }
    // public function store(Request $request)
    // {

      
    //     // تحقق من صحة الطلب
    //     $request->validate([
    //         'quantity' => ['required', 'integer'],
    //         'limit' => ['required', 'integer'],
    //         'status' => ['required', 'in:inStock,outOfStock,lowStock'],
    //         'price' => ['required', 'integer'],
            
    //     ]);

       
        
    //     // إنشاء المنتج
    //     $product = Product::create([
    //         'status' => $request->status,
    //         'limit' => $request->limit,
    //         'quantity' => $request->quantity,
    //          'price' => $request->price,

           
    //     ]);

    //     return redirect()->route('storeproduct.index'); // إعادة التوجيه بعد التخزين
    // }

    // public function edit($id)
    // {
    //     $product = Product::find($id);
    //     return view('storeproduct.create', ['product' => $product]);
    // }

    // public function update(Request $request,$product_id)
    //      {
    //         $product=Product::where('id',$product_id)->first();
    
    //         $request->validate([
    //             'quantity' => ['required', 'integer'],
    //             'limit' => ['required', 'integer'],
    //             'status' => ['required', 'in:inStock,outOfStock,lowStock'],
    //             'price' => ['required', 'integer'],
    //         ]);
     
       

    //          $product->update([
    //             'status' => $request->status,
    //             'limit' => $request->limit,
    //             'quantity' => $request->quantity,
    //              'price' => $request->price,
    //          ]);
     
            
             
    //          return redirect()->route('storeproduct.index'); 
    //         }

    //  public function destroy($product_id)
    //  { 
        
    //     $product=Product::where('id',$product_id)->first();

    //      $product->delete();
       
    //      return redirect()->route('storeproduct.index');

    //  }

   

    
    // public function show($product_id) {
    //     $product = Product::findOrFail($product_id); // Fetch the product by ID
    //     return view('storeproduct.show', compact('product')); // Pass the product to the view
    // }






        

        }
    
       
    
    


