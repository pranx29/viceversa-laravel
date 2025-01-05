<?php

namespace App\Livewire\Customer\Components;

use App\Models\Size;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class ProductFilter extends Component
{
    public $searchTerm = '';
    public $categories = [];
    public $selectedCategories = [];
    public $sizes = [];
    public $selectedSizes = [];
    public $priceRange = [0, 0];
    public $selectedPriceRange = [0, 0];

    public function mount()
    {
        $this->categories = Category::all();
        $this->sizes = Size::all();
        $this->priceRange = [0, Product::max('price')];
        $this->selectedPriceRange = [0, Product::max('price')];
    }
    public function updated()
    {
        $this->dispatch('filterProducts', [
            'searchTerm' => $this->searchTerm,
            'selectedCategories' => $this->selectedCategories,
            'selectedSizes' => $this->selectedSizes,
            'priceRange' => $this->selectedPriceRange,
        ]);
    }

    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->selectedCategories = [];
        $this->selectedSizes = [];
        $this->selectedPriceRange = [0, Product::max('price')];

        $this->dispatch('filterProducts', [
            'searchTerm' => $this->searchTerm,
            'selectedCategories' => $this->selectedCategories,
            'selectedSizes' => $this->selectedSizes,
            'priceRange' => $this->selectedPriceRange,
        ]);

        $this->selectedPriceRange = [0, Product::max('price')];
    }

    public function render()
    {
        return view('livewire.customer.components.product-filter');
    }

}
