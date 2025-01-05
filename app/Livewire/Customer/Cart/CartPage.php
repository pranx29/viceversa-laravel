<?php

namespace App\Livewire\Customer\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartPage extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    public $shipping = 250.00;
    public $total = 0;
    protected $listeners = ['updateQuantity', 'removeItem'];

    public function mount()
    {
        $this->cartItems = Cart::getCartItems();
        $this->calculateTotals();
    }

    public function updateQuantity($index, $quantity)
    {
        $this->cartItems[$index]['quantity'] = max(1, $quantity);
        $this->calculateTotals();

        Cart::updateProductQuantity($this->cartItems[$index]['product_id'], $this->cartItems[$index]['size_id'], $quantity);
    }

    public function removeItem($index)
    {
        $productToRemove = $this->cartItems[$index];
        unset($this->cartItems[$index]);
        $this->cartItems = array_values($this->cartItems);

        $this->calculateTotals();

        Cart::removeProduct($productToRemove['product_id'], $productToRemove['size_id']);
    }


    public function calculateTotals()
    {
        $this->subtotal = collect($this->cartItems)->sum(fn($product) => $product['price'] * $product['quantity']);
        $this->total = $this->subtotal + $this->shipping;
    }

    public function checkout()
    {
        return redirect()->route('cart.checkout');
    }

    public function render()
    {
        return view('livewire.customer.cart.cart-page');
    }
}
