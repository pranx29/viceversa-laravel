<?php

namespace App\Livewire\Customer\Products;

use App\Models\Cart;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public $showAddToCart = false;
    public $selectedSize;

    public function mount($product)
    {
        $this->product = $product;
        $this->selectedSize = $product->sizes->first()->id ?? null;
    }

    public function selectSize($sizeId)
    {
        $this->selectedSize = $sizeId;
    }

    public function addToCart()
    {
        Cart::addItem($this->product, $this->selectedSize);
        $this->dispatch('productAddedToCart');
    }

    public function render()
    {
        return view('livewire.customer.products.product-card');
    }
}
