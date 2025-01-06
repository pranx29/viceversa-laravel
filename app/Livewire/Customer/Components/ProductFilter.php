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

        $this->getAppliedFilter();
    }

    public function getAppliedFilter()
    {
        $filters = request()->input('filter');
        parse_str($filters, $filtersArray);

        // Extract filters
        $this->searchTerm = $filtersArray['search'] ?? '';
        $this->selectedCategories = $filtersArray['categories'] ?? [];
        $this->selectedSizes = $filtersArray['sizes'] ?? [];
        $this->priceRange = $filtersArray['price'] ?? [0, Product::max('price')];
    }

    public function updated()
    {
        // Build the url query string
        $filter = http_build_query([
            'search' => $this->searchTerm,
            'categories' => $this->selectedCategories,
            'sizes' => $this->selectedSizes,
            'price' => $this->selectedPriceRange,
        ]);

        // Redirect to the same page with the query string
        return redirect()->route('products.index', ['filter' => $filter]);
    }

    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->selectedCategories = [];
        $this->selectedSizes = [];
        $this->selectedPriceRange = [0, Product::max('price')];

        // Redirect to the same page with the query string
        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.customer.components.product-filter');
    }

}
