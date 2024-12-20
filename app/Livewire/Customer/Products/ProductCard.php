<?php

namespace App\Livewire\Customer\Products;

use Livewire\Component;

class ProductCard extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }
    
    public function render()
    {
        return view('livewire.customer.products.product-card');
    }
}
