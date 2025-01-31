<?php

namespace App\Livewire\Admin\Products;

use App\Models\Size;
use Livewire\Component;

class SizeVariantForm extends Component
{
    public $variants = [];
    public $sizes;

    protected $listeners = ['emitVariants'];

    public function mount($variants = null)
    {
        if ($variants) {
            $this->variants = $variants;
        }

        $this->sizes = Size::all()->where('status', true);

        if (empty($this->variants)) {
            $this->addVariant();
        }
    }
    public function addVariant()
    {
        if (count($this->variants) < $this->sizes->count()) {
            $this->variants[] = ['size_id' => '1', 'stock' => 0];
        }
        $this->dispatch('updateVariants', $this->variants);
    }

    // Remove a variant row
    public function removeVariant($index)
    {
        if (count($this->variants) > 1) {
            unset($this->variants[$index]);
            $this->variants = array_values($this->variants);
            $this->dispatch('updateVariants', $this->variants);
        }
    }

    public function updated()
    {
        $this->dispatch('updateVariants', $this->variants);
    }

    public function render()
    {
        return view('livewire.admin.products.size-variant-form');
    }
}
