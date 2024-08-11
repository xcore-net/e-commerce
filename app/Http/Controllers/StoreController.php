<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
class StoreController extends Controller
{
    public function index(){
        $store=Store::first();
        $products=$store->products;
        return view('welcome',['products'=>$products]);
    }
}
