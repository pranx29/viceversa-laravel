<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApiLog;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Key metrics
        $totalRevenue = Order::where('status', 'Completed')->with('items')->get()->map(function ($order) {
            return $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        })->sum();
        $orderCounts = [
            'total' => Order::count(),
            'completed' => Order::where('status', 'Completed')->count(),
            'processing' => Order::where('status', 'Processing')->count(),
            'cancelled' => Order::where('status', 'Cancelled')->count(),
        ];
        $totalCustomers = Order::whereMonth('created_at', now()->month)->distinct('user_id')->count();
        $pendingOrders = Order::where('status', 'Processing')->count();
        $lowStockProductsCount = Product::whereHas('sizes', function ($query) {
            $query->where('quantity_in_stock', '<', 5);
        })->count();


        // Top selling products name, quantity sold, and revenue
        $topSellingProducts = Order::where('status', 'Completed')->with('items.product')->get()->map(function ($order) {
            return $order->items->map(function ($item) {
            return [
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'revenue' => $item->price * $item->quantity
            ];
            });
        })->flatten(1)->groupBy('name')->map(function ($product, $name) {
            return [
            'name' => $name,
            'quantity' => $product->sum('quantity'),
            'revenue' => $product->sum('revenue')
            ];
        })->values()->sortByDesc('quantity')->take(5);


        // Low stock products name and quantity in stock
        $lowStockProducts = Product::whereHas('sizes', function ($query) {
            $query->where('quantity_in_stock', '<', 5);
        })->with('sizes')->get()->map(function ($product) {
            return [
            'name' => $product->name,
            'quantity_in_stock' => $product->sizes->sum('quantity_in_stock')
            ];
        });

        // Frequent customers name, email, and order count
        $frequentCustomers = Order::where('status', 'Completed')->with('user')->get()->map(function ($order) {
            return $order->user;
        })->groupBy('id')->map(function ($user) {
            return [
            'name' => $user->first()->first_name . ' ' . $user->first()->last_name,
            'email' => $user->first()->email,
            'order_count' => $user->count()
            ];
        })->sortByDesc('order_count')->take(5);

        // Slow api endpoint endpoint, method and avg execution time (mongoDB)
        $slowApiEndpoints = ApiLog::raw(function ($collection) {
            return $collection->aggregate([
            [
                '$group' => [
                '_id' => [
                    'endpoint' => '$endpoint',
                    'method' => '$method'
                ],
                'avg_execution_time' => [
                    '$avg' => '$execution_time'
                ]
                ]
            ],
            [
                '$sort' => [
                'avg_execution_time' => -1
                ]
            ],
            [
                '$limit' => 5
            ]
            ]);
        });


        return view('admin.dashboard.index', [
            'totalRevenue' => $totalRevenue,
            'orderCounts' => $orderCounts,
            'totalCustomers' => $totalCustomers,
            'pendingOrders' => $pendingOrders,
            'lowStockProductsCount' => $lowStockProductsCount,
            'lowStockProducts' => $lowStockProducts,
            'topSellingProducts' => $topSellingProducts,
            'frequentCustomers' => $frequentCustomers,
            'slowApiEndpoints' => $slowApiEndpoints
        ]);
    }
}
