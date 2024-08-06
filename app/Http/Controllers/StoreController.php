<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $store = Store::first();
        $products = $store->products;
        return view('store', ['products' => $products]);
    }
    public function getStores(): View
    {
        $stores = Store::all();
        return view('store.stores', ['stores' => $stores]);
    }
    public function create(): View
    {
        return view('store.create');
    }
    public function store(Request $request)
    {
        Store::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);
    }

    public function show($id)
    {
        $store = Store::find($id);
        $products = Product::all();

        return view('store.show', ['store' => $store, 'storeProducts' => $store->products, 'products' => $products]);
    }

    public function addProduct($id,Request $request)
    {
        $store = Store::find($id);
        $product_id = $request->product_id;

        $store->products()->attach($product_id, [
            'quantity' => $request->quantity,
            'limit' => $request->limit,
            'price' => $request->price,
            'status' => $request->quantity>$request->limit?'InStock':'LowStock'
        ]);

    }
}
