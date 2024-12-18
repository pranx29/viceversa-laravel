<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        // Return all products as JSON Product::all()
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }
}
