<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::all();

        return response()->json($products);
    }
    public function getProduct($id)
    {
        $product = Product::find($id)->first();

        return response()->json($product);
    }
    public function createProduct(Request $request)
    {
        $path = $request->file('img')->store('images', 'public');
        Product::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'amount' => $request->amount,
            'category' => $request->category,
            'img' => $path,
        ]);

        return response()->json("Product created");
    }
    public function updateProduct($id, Request $request)
    {
        $product = Product::find($id);

        $path = $request->file('img')->store('images', 'public');
        $product->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'amoun' => $request->amount,
            'cateogry' => $request->cateogory,
            'img' => $path,
        ]);


        return response()->json("Product update");
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json("Product deleted");
    }
}
