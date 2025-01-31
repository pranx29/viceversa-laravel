<?php

namespace App\Livewire\Customer\Products;

use App\Models\Product;
use Livewire\Component;

class ProductListing extends Component
{
    public $products = [];
    public $sortOption = '';

    public function mount()
    {
        ;
        $this->sortOption = request()->input('sort') ?? '';
    }

    public function updatedSortOption($value)
    {
        $this->sortOption = $value;
        redirect()->route('products.index', ['sort' => $value]);
    }

    public function render()
    {
        return view('livewire.customer.products.product-listing');
    }

}


