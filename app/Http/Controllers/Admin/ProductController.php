<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        if(request()->has('active')) {
            $products = Product::where('is_active', request('active'))->paginate(10);
        } else {
            $products = Product::paginate(10);
        }
        return view('admin.products.index', [
            'products' => $products,
        ]);

    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('admin.products.show', [
            'product' => $product,
        ]);
    }
}
