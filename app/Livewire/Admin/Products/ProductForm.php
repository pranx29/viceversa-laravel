<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductForm extends Component
{
    use WithFileUploads;

    public $productId;
    public $name;
    public $description;
    public $categoryId;
    public $price;
    public $discount = 0;
    public $status = 1;
    public $images = [];
    public $variants = [];

    protected $listeners = ['sizeVariants' => 'updateVariants', 'productImages' => 'updateImages', 'save'];

    public function mount($product = null)
    {
        if ($product) {
            $this->productId = $product->id;
            $product->load('images', 'sizes');
            $this->product_id = $product->id;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->categoryId = $product->category_id;
            $this->price = $product->price;
            $this->discount = $product->discount ?? 0;
            $this->status = $product->status;
            $this->images = $product->images->toArray();
            $this->variants = $product->sizes->map(function ($size) {
                return [
                    'size_id' => $size->id,
                    'stock' => $size->pivot->quantity_in_stock,
                ];
            })->toArray();
        }

    }

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
                'categoryId' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0',
                'status' => 'required|in:1,0',
            ],
        );

        \DB::beginTransaction();

        try {
            if ($this->productId) {
                $product = \App\Models\Product::findOrFail($this->productId);
                $product->update([
                    'name' => $this->name,
                    'description' => $this->description,
                    'category_id' => $this->categoryId,
                    'price' => $this->price,
                    'discount' => $this->discount,
                    'status' => $this->status,
                ]);
                $product->images()->delete();
                $product->sizes()->detach();
            } else {
                $product = \App\Models\Product::create([
                    'name' => $this->name,
                    'description' => $this->description,
                    'category_id' => $this->categoryId,
                    'price' => $this->price,
                    'discount' => $this->discount,
                    'status' => $this->status,
                ]);
            }

            foreach ($this->images as $image) {
                $product->images()->create([
                    'path' => $image['path'],
                    'order' => $image['order'],
                ]);
            }

            foreach ($this->variants as $variant) {
                $product->sizes()->attach($variant['size_id'], ['quantity_in_stock' => $variant['stock']]);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', $e->getMessage());
            return;
        }
        session()->flash('message', 'Product saved successfully');
        redirect()->route('admin.products.show', $product);

    }

    public function prepareAndSave()
    {
        // TODO: Complete update product 
        if ($this->productId) {
            session()->flash('message', 'Product updated successfully');
            return;
        }
        $this->dispatch('emitVariants')->to('admin.products.size-variant-form');
        $this->dispatch('emitImages')->to('admin.products.product-images-form');
    }

    public function discard()
    {
        redirect()->route('admin.products.index');
    }

    public function render()
    {
        $categories = \App\Models\Category::all();
        $sizes = \App\Models\Size::all();
        return view('livewire.admin.products.product-form', compact('categories', 'sizes'));
    }
}
