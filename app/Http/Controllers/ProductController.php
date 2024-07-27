<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();

        return view('product.index', ['products' => $products]);
    }

    //show create page
    public function create(): View
    {
        return view('product.create');
    }

    //store details
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'desc' => ['required', 'string'],
        //     'price' => ['required', 'integer'],
        //     'amount' => ['required', 'integer', 'digits:6'],
        //     'category' => ['required', 'string'],
        //     'img' => ['required', 'string'],
        // ]);

        $path = $request->file('img')->store('images', 'public');
       
        Product::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'amount' => $request->amount,
            'category' => $request->category,
            'img' => $path
        ]);

        return redirect(route('product.index', absolute: false));
    }

    public function edit($id):View
    {
        $product = Product::find($id);
        return view('product.create', ['product' => $product]);
    }

    public function update($id, Request $request):RedirectResponse
    {
        // $request->validate([
        //     'title' => ['required', 'string', 'max:255'],
        //     'desc' => ['required', 'string'],
        //     'price' => ['required', 'in:visa,paypal'],
        //     'amount' => ['required', 'integer', 'digits:6'],
        //     'category' => ['required', 'string'],
        // ]);

        $product = Product::find($id);
        $path = $request->file('img')->store('images', 'public');
        $product->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'price' => $request->price,
            'amount' => $request->amount,
            'cateogry' => $request->cateogory,
            'img' => $path,
        ]);

        return redirect(route('product.index', absolute: false));
    }
    public function destroy($id):RedirectResponse
    {
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product.index', absolute: false));
    }
}