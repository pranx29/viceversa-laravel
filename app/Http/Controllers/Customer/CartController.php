<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function show()
    {
        return view('customer.cart.index', [
            'cartItems' => Cart::getCartItems(),
        ]);
    }
}
