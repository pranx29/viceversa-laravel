<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        // Fetch all orders from the database based on status from request
        if(request()->has('status')){
            $orders = Order::where('status', request('status'))->paginate(10);
        }else{
            $orders = Order::paginate(2);
        }

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order
        ]);
    }
}
