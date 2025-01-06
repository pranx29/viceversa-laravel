<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function home()
    {

        $bestSellerProducts = Product::inRandomOrder()->take(4)->get();
        $newArrivalProducts = Product::inRandomOrder()->take(4)->get();
        return view('customer.home.index', compact('bestSellerProducts', 'newArrivalProducts'));
    }
}
