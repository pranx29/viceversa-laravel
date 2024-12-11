<?php

namespace App\Livewire\Customer\Cart;

use Livewire\Component;

class CartItem extends Component
{
    public $product;
    public $index;
    public $total;

    public function mount($product, $index)
    {
        $this->product = $product;
        $this->index = $index;
        $this->calculateTotal();
    }

    public function increment()
    {
        $this->product['quantity']++;
        $this->dispatch('updateQuantity', $this->index, $this->product['quantity']);
        $this->calculateTotal();
    }
    public function decrement()
    {
        if ($this->product['quantity'] > 1) {
            $this->product['quantity']--;
            $this->dispatch('updateQuantity', $this->index, $this->product['quantity']);
            $this->calculateTotal();
        }
    }

    public function calculateTotal()
    {
        $this->total = $this->product['price'] * $this->product['quantity'];
    }

    public function remove()
    {
        $this->dispatch('removeProduct', $this->index);
    }

    public function render()
    {
        return view('livewire.customer.cart.cart-item');
    }
}
