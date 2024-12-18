<?php

namespace App\Http\Controllers\API;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Determine if the user is logged in or a guest
        $user_id = Auth::check() ? Auth::id() : null;
        $guest_id = !$user_id ? session()->getId() : null;

        // Retrieve the cart for the user or guest
        $cartItems = Cart::where('user_id', $user_id)
            ->orWhere('guest_id', $guest_id)
            ->first();

        // convert the JSON to an array
        $cartItems = $cartItems ? $cartItems->products : [];
        return response()->json([
            'cart' => $cartItems
        ]);
    }
}
