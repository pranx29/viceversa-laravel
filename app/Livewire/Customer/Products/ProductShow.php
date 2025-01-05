<?php

namespace App\Livewire\Customer\Products;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductShow extends Component
{
    public $product;
    public $selectedSize;
    public $selectedImage;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->selectedSize = $product->sizes->first()->id ?? null;
        $this->selectedImage = $product->images->where('order', 1)->first()->path ?? null;
    }

    public function selectSize($sizeId)
    {
        $this->selectedSize = $sizeId;
    }

    public function selectImage($imagePath)
    {
        $this->selectedImage = $imagePath;
    }

    public function addToCart()
    {
        Cart::addItem($this->product, $this->selectedSize);
        $this->dispatch('productAddedToCart');
    }
    public function render()
    {
        return view('livewire.customer.products.product-show');
    }
}
