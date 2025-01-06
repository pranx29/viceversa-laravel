<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::paginate(10);
        return view('admin.products.index', [
            'products' => $products,
        ]);

    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product,
        ]);
    }
}
