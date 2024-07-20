<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('order.index', ['orders' => $orders]);
    }

    // Show create page
    public function create(): View
    {
        return view('order.create');
    }

    // Store details
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        ]);

        $order = Order::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'total_price' => $request->total_price,
        ]);

        return redirect(route('order.index', absolute: false));
    }

    public function edit($id): View
    {
        $order = Order::find($id);
        return view('order.create', ['order' => $order]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        $request->validate([
            'total_price' => ['required', 'decimal'],
        ]);

        $order = Order::find($id);

        $order->update([
            'total_price' => $request->price,
        ]);

        return redirect(route('order.index', absolute: false));
    }

    public function destroy($id): RedirectResponse
    {
        $order = Order::find($id);
        $order->delete();
        return redirect(route('order.index', absolute: false));
    }
}
