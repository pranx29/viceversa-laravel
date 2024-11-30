<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function home()
    {
        
        $products = Product::all();
        return view('customer.home.index', compact('products'));
    }
}
