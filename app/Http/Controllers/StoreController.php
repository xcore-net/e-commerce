<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('store', ['products' => $products]);
    }
}
