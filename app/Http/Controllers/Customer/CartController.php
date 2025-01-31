<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get the unique identifier for the guest user.
     *
     * @return string
     */
    protected function getGuestId()
    {
        if (!session()->has('guest_id')) {
            session(['guest_id' => Str::uuid()->toString()]);
        }
        return session('guest_id');
    }

    public function show()
    {
        return view('customer.cart.index', [
            'cartItems' => Cart::getCartItems(),
        ]);
    }

    public function checkout()
    {
        return view('customer.cart.checkout', [
        ]);
    }
}
