<?php

namespace App\Livewire\Admin\Sizes;

use App\Models\Size;
use Livewire\Component;

class SizeManagement extends Component
{
    public $sizes = [];
    public $newSize = ['name' => ''];
    public $editingId = null;

    public function mount()
    {
        $this->sizes = Size::all()->toArray();
    }

    public function addSize()
    {
        // Validate the new size
        $this->validate(
            [
                'newSize.name' => 'required|unique:sizes,name,' . $this->editingId,
            ],
            [
                'newSize.name.unique' => 'The size name must be unique.',
                'newSize.name.required' => 'The size name is required.',
            ]
        );

        // Check if we are editing or adding a new size
        if ($this->editingId) {
            Size::find($this->editingId)->update($this->newSize);
            $this->editingId = null;
        } else {
            Size::create($this->newSize);
        }
        $this->newSize = ['name' => ''];
        $this->sizes = Size::all()->toArray();
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'sizes.')) {
            $index = explode('.', $propertyName)[1];
            $size = Size::find($this->sizes[$index]['id']);
            $size->status = $this->sizes[$index]['status'];
            $size->save();

        }


    }


    public function editSize($id)
    {
        $this->editingId = $id;
        $this->newSize = $this->sizes[array_search($id, array_column($this->sizes, 'id'))];
    }

    public function cancelEdit()
    {
        $this->newSize = ['name' => ''];
        $this->editingId = null;
    }
    public function render()
    {
        return view('livewire.admin.sizes.size-management');
    }
}
