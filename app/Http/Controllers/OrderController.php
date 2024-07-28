<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $orders = $user->orders;

        return view('order.index', ['orders' => $orders]);
    }
    public function show($id)
    {
        $order = Order::find($id);
        $methods = ['visa', 'paypal'];

        return view('order.show', ['order'=>$order, 'methods'=>$methods,'payment'=>$order->payment]);
    }

    public function destroy($id): RedirectResponse
    {
        $order = Order::find($id);
        $order->delete();

        return redirect(route('order.index', absolute: false));
    }

    public function pay($id, Request $request): RedirectResponse
    {
        // $request->validate([
        //     'method' => ['required', 'in:visa,paypal'],
        // ]);

        $user = Auth::user();
        $order = Order::find($id);

        $payment = Payment::create([
            'user_id' => $user->id,
            'amount' => $order->total_price,
            'method' => $request->method
        ]);

        $order->payment_id = $payment->id;
        $order->save();

        return redirect(route('order.index', absolute: false));
    }
}
