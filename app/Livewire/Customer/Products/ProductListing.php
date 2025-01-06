<?php

namespace App\Livewire\Customer\Products;

use App\Models\Product;
use Livewire\Component;

class ProductListing extends Component
{
    public $products = [];
    public $sortOption = '';

    public function updatedSortOption($value)
    {
        $this->sortOption = $value;
        $this->applySort();
    }

    public function applySort()
    {
        $query = Product::query();

        switch ($this->sortOption) {
            case 'featured':
                $query->orderBy('featured', 'desc');
                break;
            case 'priceLowToHigh':
                $query->orderBy('price', 'asc');
                break;
            case 'priceHighToLow':
                $query->orderBy('price', 'desc');
                break;
            case 'nameAZ':
                $query->orderBy('name', 'asc');
                break;
            case 'nameZA':
                $query->orderBy('name', 'desc');
                break;
        }

        $products = $query->get();
        return redirect()->route('products.index', compact('products'));
    }

    public function render()
    {
        return view('livewire.customer.products.product-listing');
    }

}


