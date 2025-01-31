<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryManagement extends Component
{
    use WithFileUploads;

    public $categories = [];
    public $newCategory = ['name' => '', 'image' => null, 'status' => true];
    public $editingId = null;
    public $tempImage = null;

    public function mount()
    {
        $this->categories = Category::all()->toArray();
    }

    public function addCategory()
    {
        // Validate the new category
        $this->validate(
            [
                'newCategory.name' => 'required|unique:categories,name,' . $this->editingId,
                'newCategory.image' => $this->editingId ? 'nullable|image|max:2048' : 'required|image|max:2048',
            ],
            [
                'newCategory.name.unique' => 'The category name must be unique.',
                'newCategory.name.required' => 'The category name is required.',
                'newCategory.image.required' => 'The category image is required.',
                'newCategory.image.image' => 'The category image must be an image.',
                'newCategory.image.max' => 'The category image must not exceed 2MB.',
            ]
        );

        // Handle image upload
        if ($this->newCategory['image']) {
            $imagePath = $this->newCategory['image']->store('categories', 'public');
            $this->newCategory['image'] = $imagePath;
        }

        // Check if we are editing or adding a new category
        if ($this->editingId) {
            $category = Category::find($this->editingId);
            $category->update(
                [
                    'name' => $this->newCategory['name'],
                    'image' => $this->newCategory['image'] ?? $this->tempImage,
                    'status' => $this->newCategory['status'],
                ]
            );
            $this->editingId = null;
        } else {
            Category::create($this->newCategory);
        }

        // Reset the form
        $this->newCategory = ['name' => '', 'image' => null, 'status' => true];
        $this->categories = Category::all()->toArray();
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'categories.')) {
            $index = explode('.', $propertyName)[1];
            $category = Category::find($this->categories[$index]['id']);
            $category->status = $this->categories[$index]['status'];
            $category->save();
        }
    }

    public function editCategory($id)
    {
        $this->editingId = $id;
        $this->newCategory = $this->categories[array_search($id, array_column($this->categories, 'id'))];
        $this->tempImage = $this->newCategory['image'];
        $this->newCategory['image'] = null;
    }

    public function cancelEdit()
    {
        $this->newCategory = ['name' => '', 'image' => null, 'status' => true];
        $this->editingId = null;
        $this->tempImage = null;
    }

    public function render()
    {
        return view('livewire.admin.categories.category-management');
    }
}
