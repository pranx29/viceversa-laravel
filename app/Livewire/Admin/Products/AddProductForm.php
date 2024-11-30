<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;

class AddProductForm extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $category_id;
    public $price;
    public $discount;
    public $status = 1;
    public $images = [];
    public $size_ids = [];
    public $size_quantities = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|integer',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
        'status' => 'required|boolean',
        'size_ids' => 'required|array|min:1',
        'size_ids.*' => 'required|integer|exists:sizes,id',
        'size_quantities' => 'required|array|min:1',
        'size_quantities.*' => 'required|integer|min:0',
        'images' => 'required|array|min:4|max:4',
        'images.*' => 'required|image|max:1024',
    ];

    public function getSelectedSizesWithQuantities()
    {
        $sizesWithQuantities = [];

        foreach ($this->size_ids as $sizeId) {
            if (isset($this->size_quantities[$sizeId]) && $this->size_quantities[$sizeId] > 0) {
                $sizesWithQuantities[] = [
                    'size_id' => $sizeId,
                    'quantity' => $this->size_quantities[$sizeId],
                ];
            }
        }

        return $sizesWithQuantities;
    }

    public function submit()
    {
        $this->validate();

        \DB::beginTransaction();

        try {
            $product = \App\Models\Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'price' => $this->price,
                'discount' => $this->discount,
                'status' => $this->status,
            ]);

            $order = 1;
            foreach ($this->images as $image) {
                $product->images()->create([
                    'path' => $image->store("product_images/{$product->slug}/", 'public'),
                    'order' => $order++,
                ]);
            }

            foreach($this->getSelectedSizesWithQuantities() as $sizeWithQuantity) {
                $product->sizes()->create([
                    'size_id' => $sizeWithQuantity['size_id'],
                    'quantity_in_stock' => $sizeWithQuantity['quantity'],
                ]);
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', $e->getMessage());
            return;
        }

        session()->flash('message', 'Product created successfully!');
    }

    public function render()
    {
        $categories = \App\Models\Category::all();
        $sizes = \App\Models\Size::all();
        return view('livewire.admin.products.add-product-form', compact('categories', 'sizes'));
    }
}
