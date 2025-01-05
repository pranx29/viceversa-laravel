<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AddProductImages extends Component
{
    use WithFileUploads;

    public $images = [];
    public $maxImages = 6;
    protected $listeners = ['emitImages'];

    public function updatedImages()
    {
        if (count($this->images) > $this->maxImages) {
            $this->images = array_slice($this->images, 0, $this->maxImages);
        }
    }

    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            unset($this->images[$index]);
            $this->images = array_values($this->images);
        }
    }
    public function updateImageOrder($index, $newOrder)
    {
        $newOrder = max(1, min($newOrder, count($this->images))); // Ensure the order is valid
        $item = $this->images[$index];
        unset($this->images[$index]);

        // Insert the item into the new position
        array_splice($this->images, $newOrder - 1, 0, [$item]);

        // Re-index the array
        $this->images = array_values($this->images);
    }

    public function emitImages()
    {
        $imagePaths = [];
        foreach ($this->images as $image) {
            $storedPath = $image->store('product_images', 'public');

            $imagePaths[] = [
                'path' => $storedPath,
                'order' => count($imagePaths) + 1,
            ];
        }

        $this->dispatch('productImages', $imagePaths);
        $this->dispatch('save');
    }

    public function render()
    {
        return view('livewire.admin.products.add-product-images');
    }
}
