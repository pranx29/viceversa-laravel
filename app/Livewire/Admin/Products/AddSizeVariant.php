<?php

namespace App\Livewire\Admin\Products;

use App\Models\Size;
use Livewire\Component;

class AddSizeVariant extends Component
{
    public $variants = [];
    public $sizes;

    protected $listeners = ['emitVariants'];

    public function mount()
    {
        $this->sizes = Size::all();
        $this->addVariant();
    }
    public function addVariant()
    {
        if (count($this->variants) < $this->sizes->count()) {
            $this->variants[] = ['size_id' => '1', 'stock' => 0];
        }
    }

    // Remove a variant row
    public function removeVariant($index)
    {
        if (count($this->variants) > 1) {
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants);
        }
    }

    public function emitVariants()
    {
        $this->dispatch('sizeVariants', $this->variants);
    }

    public function render()
    {
        return view('livewire.admin.products.add-size-variant');
    }
}
