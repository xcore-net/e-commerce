<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    
    public function getOrders()
    {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function getOrdersByUser(Request $request)
    {
        $orders = Order::where('user_id',$request->user_id)->get();

        return response()->json($orders);
    }
    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
