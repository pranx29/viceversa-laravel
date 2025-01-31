<div class="space-y-8">
    <!-- Add/Edit Category Card -->
    <div class="rounded-lg p-6 bg-primary">
        <div>
            <h3 class="text-2xl font-bold mb-2 text-primary-foreground">
                {{ $editingId ? 'Edit Category' : 'Add New Category' }}
            </h3>
        </div>
        <div class="card-content">
            <div class="flex space-x-4 justify-center items-center">
                <div class="flex-grow">
                    <x-input-label for="categoryName" :value="__('Category Name')" />
                    <x-text-input wire:model.defer="newCategory.name" id="categoryName" type="text" class="w-full"
                        placeholder="Enter category name" />
                    <x-input-error :messages="$errors->get('newCategory.name')" class="mt-2" />
                </div>
                <div class="flex-grow">
                    <x-input-label for="categoryImage" :value="__('Category Image')" />
                    <input wire:model="newCategory.image" id="categoryImage" type="file" class="w-full text-primary-foreground" />
                    <x-input-error :messages="$errors->get('newCategory.image')" class="mt-2" />
                </div>
                <button wire:click="addCategory"
                    class="rounded-lg bg-button px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                    {{ $editingId ? 'Update' : 'Save' }}
                </button>
                @if ($editingId)
                    <button wire:click="cancelEdit"
                        class="rounded-lg bg-background text-foreground px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                        Cancel
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Categories List Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="text-2xl font-bold mb-2 text-primary-foreground">Categories List</h3>
        </div>
        <div class="card-content">
            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max">
                    <thead>
                        <tr class="border-b border-foreground bg-primary">
                            <th class="p-4 text-sm font-normal leading-none text-foreground">ID</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Name</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Image</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Status</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="cursor-pointer">
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    {{ $category['id'] }}
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    {{ $category['name'] }}
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}"
                                        class="w-10 h-10 rounded-full" style="filter: brightness(0) invert(1);">
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <input type="checkbox" wire:model.live="categories.{{ $loop->index }}.status"
                                        class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary focus:border-primary checked:bg-background"
                                        {{ $category['status'] ? 'checked' : '' }} />
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3 space-x-4">
                                    <button wire:click="editCategory('{{ $category['id'] }}')">
                                        <x-iconsax-lin-edit
                                            class="text-foreground hover:text-foreground/80 transition duration-300 ease-in-out size-5" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
