<?php

namespace App\Livewire;
use Livewire\WithFileUploads;

use Livewire\Component;

class ProductForm extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $category_id;
    public $price;
    public $status = 1;
    public $variants = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|integer',
        'price' => 'required|numeric|min:0',
        'status' => 'required|boolean',
        'variants.*.color' => 'required|exists:colors,id',
        'variants.*.size' => 'required|in:',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.image1' => 'required|image|max:1024',
        'variants.*.image2' => 'required|image|max:1024',

    ];

    public function __construct()
    {
        $this->rules['variants.*.size'] .= implode(',', \App\Models\ProductVariant::SIZE);
    }

    public function addVariant()
    {
        $this->variants[] = ['color' => '', 'size' => '', 'stock' => '', 'image1' => '', 'image2' => ''];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants); // Re-index the array
    }

    public function submit()
    {
        $this->validate();

        \DB::transaction(function () {
            $product = \App\Models\Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'price' => $this->price,
                'is_active' => $this->status,
            ]);

            foreach ($this->variants as $variant) {
                $image1 = $variant['image1']->store('product_images', 'public');
                $image2 = $variant['image2']->store('product_images', 'public');
                $productVariant = $product->variants()->create([
                    'color_id' => $variant['color'],
                    'size' => $variant['size'],
                    'stock' => $variant['stock'],
                ]);
                $productVariant->images()->create([
                    'image_path' => $image1,
                    'order' => 1,
                ]);
                $productVariant->images()->create([
                    'image_path' => $image2,
                    'order' => 2,
                ]);
            }
        });

        session()->flash('message', 'Product created successfully!');
    }

    public function render()
    {
        return view('livewire.product-form', [
            'categories' => \App\Models\Category::all(),
            'colors' => \App\Models\Color::all(),
            'sizes' => \App\Models\ProductVariant::SIZE,
        ]);
    }
}
