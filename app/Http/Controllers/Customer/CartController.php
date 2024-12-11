<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'products' => 'required|array', // Validate the cart products
            'products.*.product_id' => 'required|string', // Each product should have a product_id
            'products.*.size_id' => 'required|string', // Size ID (previously variant_id)
            'products.*.quantity' => 'required|integer|min:1', // Quantity should be a positive integer
            'products.*.price' => 'required|numeric', // Price should be a number
            'products.*.discount' => 'nullable|numeric', // Discount is optional
            'products.*.total_price' => 'required|numeric', // Total price should be a number
            'products.*.image' => 'required|url', // Product image URL is required
        ]);

        // Determine if the user is logged in or a guest
        $user_id = Auth::check() ? Auth::id() : null;
        $guest_id = !$user_id ? session()->getId() : null;

        // Create or update the cart
        $cart = Cart::updateOrCreate(
            ['user_id' => $user_id, 'guest_id' => $guest_id],
            [
                'products' => $request->input('products'),
                'updated_at' => now(),
            ]
        );

        dd($cart);

    }

    public function show()
    {
        // Determine if the user is logged in or a guest
        // $user_id = Auth::check() ? Auth::id() : null;
        $user_id = 1;
        $guest_id = !$user_id ? session()->getId() : null;

        // Retrieve the cart for the user or guest
        $cartItems = Cart::where('user_id', $user_id)
            ->orWhere('guest_id', $guest_id)
            ->first();

        // convert the JSON to an array
        $cartItems = $cartItems ? $cartItems->products : [];

        return view('customer.cart.index', [
            'cartItems' => $cartItems,
        ]);
    }

    public function add()
    {
        $cart = Cart::create([
            'user_id' => Auth::id(),
            'guest_id' => null,
            'products' => [
                [
                    'id' => '1',
                    'name' => 'Denim Jacket',
                    'size' => [
                        'id' => '1',
                        'name' => 'M',
                    ],
                    'quantity' => 1,
                    'price' => 5000,
                    'discount' => 0,
                    'image' => 'https://example.com/path/to/product_image.jpg'
                ],
                [
                    'id' => '2',
                    'name' => 'T-Shirt',
                    'size' => [
                        'id' => '2',
                        'name' => 'L',
                    ],
                    'quantity' => 2,
                    'price' => 10000,
                    'discount' => 0,
                    'image' => 'https://example.com/path/to/product_image.jpg'
                ],
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        dd(Cart::all());
    }
}
