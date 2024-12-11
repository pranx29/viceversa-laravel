<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


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
    public $variants = [];

    protected $listeners = ['sizeVariants' => 'updateVariants', 'productImages' => 'updateImages', 'save'];

    public function updateVariants($variants)
    {
        $this->variants = $variants;
    }

    public function updateImages($images)
    {
        $this->images = $images;
    }

    public function save()
    {
        $this->validate(
            [
                'name' => 'required|string|max:25|min:3',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0',
                'status' => 'required|in:1,0',
            ],
        );

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

            foreach ($this->images as $image) {
                $product->images()->create([
                    'path' => $image['path'],
                    'order' => $image['order'],
                ]);
            }

            foreach ($this->variants as $variant) {
                $product->sizes()->create([
                    'size_id' => $variant['size_id'],
                    'quantity_in_stock' => $variant['stock'],
                ]);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', $e->getMessage());
            return;
        }
        session()->flash('message', 'Product saved successfully!');
    }

    public function prepareAndSave()
    {
        $this->dispatch('emitVariants')->to('admin.products.add-size-variant');
        $this->dispatch('emitImages')->to('admin.products.add-product-images');
    }

    public function render()
    {
        $categories = \App\Models\Category::all();
        $sizes = \App\Models\Size::all();
        return view('livewire.admin.products.add-product-form', compact('categories', 'sizes'));
    }
}
