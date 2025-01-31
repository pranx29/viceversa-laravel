<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function home()
    {

        // Get best seller products based on the number of order items sold
        $bestSellerProducts = Product::with('orderItems')->selectRaw('products.*, SUM(order_items.quantity) as total_product_sold')
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->where('products.discount', '=', 0)
            ->groupBy('products.id')
            ->orderBy('total_product_sold', 'desc')
            ->take(4)
            ->get();

        // Get discounted products
        $discountedProducts = Product::where('discount', '>', 0)->take(4)->get();
        return view('customer.home.index', compact('bestSellerProducts', 'discountedProducts'));
    }
}
