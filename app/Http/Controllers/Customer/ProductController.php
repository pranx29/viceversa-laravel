<?php

namespace App\Http\Controllers\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        // if filters are applied
        if (request()->has('filter')) {
            // Decode and extract filter parameters
            $filters = request()->input('filter');
            parse_str($filters, $filtersArray); // Decode the filter string if it's URL encoded

            // Extract filters
            $searchTerm = $filtersArray['search'] ?? '';
            $selectedCategories = $filtersArray['categories'] ?? [];
            $selectedSizes = $filtersArray['sizes'] ?? [];
            $priceRange = $filtersArray['price'] ?? [0, Product::max('price')]; // Default price range

            // Start a query to filter products
            $query = Product::query();

            // Apply search filter
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhereHas('category', function ($q) use ($searchTerm) {
                            $q->where('name', 'like', '%' . $searchTerm . '%');
                        })
                        ->orWhereHas('sizes', function ($q) use ($searchTerm) {
                            $q->where('name', 'like', '%' . $searchTerm . '%');
                        });
                });
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

            // Apply price range filter (ensure it's always an array of two elements)
            if (count($priceRange) == 2) {
                $query->whereBetween('price', $priceRange);
            }

            // Fetch filtered products
            $products = $query->get();
        } else {
            // If no filters, fetch all products (most recent first)
            $products = Product::latest()->get();
        }

        if (request()->has('sort')) {
            $sort = request()->input('sort');
            if ($sort == 'priceLowToHigh') {
                $products = $products->sortBy('price');
            } elseif ($sort == 'priceHighToLow') {
                $products = $products->sortByDesc('price');
            } elseif ($sort == 'nameAZ') {
                $products = $products->sortBy('name');
            } elseif ($sort == 'nameZA') {
                $products = $products->sortByDesc('name');
            }
        }

        // Return the view with filtered products
        return view('customer.product.index', compact('products'));
    }






    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('customer.product.show', compact('product'));
    }
}
