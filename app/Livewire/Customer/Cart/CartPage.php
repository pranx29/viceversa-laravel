<?php

namespace App\Livewire\Customer\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartPage extends Component
{
    public $products = [];
    public $subtotal = 0;
    public $shipping = 17.00;
    public $total = 0;
    protected $listeners = ['updateQuantity', 'removeProduct'];

    public function mount($products)
    {
        $this->products = $products;
        $this->calculateTotals();
    }

    public function updateQuantity($index, $quantity)
    {
        $this->products[$index]['quantity'] = max(1, $quantity);
        $this->calculateTotals();

        Cart::updateProductQuantity($this->products[$index]['product_id'], $this->products[$index]['size']['id'], $quantity);
    }

    public function removeProduct($index)
    {
        $productToRemove = $this->products[$index];
        unset($this->products[$index]);
        $this->products = array_values($this->products);

        $this->calculateTotals();

        Cart::removeProduct($productToRemove['product_id'], $productToRemove['size']['id']);
    }


    public function calculateTotals()
    {
        $this->subtotal = collect($this->products)->sum(fn($product) => $product['price'] * $product['quantity']);
        $this->total = $this->subtotal + $this->shipping;
    }

    public function render()
    {
        return view('livewire.customer.cart.cart-page');
    }
}
