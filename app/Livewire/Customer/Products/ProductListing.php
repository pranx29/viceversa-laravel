<?php

namespace App\Livewire\Customer\Products;

use App\Models\Product;
use Livewire\Component;

class ProductListing extends Component
{
    public $products = [];

    protected $listeners = ['filterProducts' => 'applyFilters'];

    public function applyFilters($filters)
    {
        $searchTerm = $filters['searchTerm'];
        $selectedCategories = $filters['selectedCategories'];
        $selectedSizes = $filters['selectedSizes'];
        $priceRange = $filters['priceRange'];

        // Start a query to filter products
        $query = Product::query();

        // Apply search filter
        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Apply category filter
        if (!empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }

        // Apply size filter
        if (!empty($selectedSizes)) {
            $query->whereHas('sizes', function ($q) use ($selectedSizes) {
                $q->whereIn('size_id', $selectedSizes);
            });
        }

        // Apply price range filter
        $query->whereBetween('price', $priceRange);

        // Get the filtered products and update the filtered products array
        $this->products = $query->get();
    }

    public function render()
    {
        return view('livewire.customer.products.product-listing');
    }
}
