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

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::check() ? Auth::id() : $this->getGuestId();

        $cart = Cart::updateOrCreate(
            ['user_id' => $userId],
            ['items' => [], 'total_price' => 0]
        );

        $product = Product::find($request->product_id);
        $item = [
            'product_id' => $product->_id,
            'quantity' => $request->quantity,
            'price' => $product->price,
        ];

        $cart->items[] = $item;
        $cart->total_price += $product->price * $request->quantity;
        $cart->save();

        dd($cart);
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
            'cartItems' => Cart::getCartItems(),
            'shippingCost' => 250.00,
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = $this->getCart();

        $cart->items[] = [
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ];

        $cart->save();

        return redirect()->route('cart.view');
    }

}
