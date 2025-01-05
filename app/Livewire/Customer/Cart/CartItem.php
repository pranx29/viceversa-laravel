<?php

namespace App\Livewire\Customer\Cart;

use App\Models\Product;
use Livewire\Component;

class CartItem extends Component
{
    public $productName;
    public $price;
    public $quantity;
    public $image;
    public $size;
    public $index;
    public $total;

    public function mount($item, $index)
    {
        $product = Product::find($item['product_id']);

        $this->productName = $product->name;
        $this->price = $product->price;
        $this->quantity = $item['quantity'];
        $this->image = $product->primaryImage();
        $this->size = $product->sizes()->find($item['size_id'])->name;
        $this->index = $index;

        $this->calculateTotal();
    }

    public function increment()
    {
        $this->quantity++;
        $this->dispatch('updateQuantity', $this->index, $this->quantity);
        $this->calculateTotal();
        $this->dispatch('productAddedToCart');
    }
    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->dispatch('updateQuantity', $this->index, $this->quantity);
            $this->calculateTotal();
            $this->dispatch('productRemoveFromCart');
        }

    }

    public function calculateTotal()
    {
        $this->total = $this->price * $this->quantity;
    }

    public function remove()
    {
        $this->dispatch('removeItem', $this->index);
        $this->dispatch('productRemoveFromCart', $this->quantity);
    }

    public function render()
    {
        return view('livewire.customer.cart.cart-item');
    }
}
