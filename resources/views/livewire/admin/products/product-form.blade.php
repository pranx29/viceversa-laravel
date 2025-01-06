<div class="max-w-7xl mx-auto sm:px-12 lg:px-16 min-h-screen">
    <!-- Heading and Back arrow to products -->
    <div class="flex items-center gap-4 justify-between">
        <h2 class="text-2xl font-bold text-primary-foreground sm:text-3xl">
            {{ $productId ? 'Edit Product' : 'Create Product' }}
        </h2>
        <div class="flex justify-end gap-4">
            <button wire:click="discard"
                class="rounded-lg bg-primary text-foreground px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                Discard
            </button>
            <button wire:click="prepareAndSave"
                class="rounded-lg bg-button px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                {{ $productId ? 'Update' : 'Save' }}
            </button>
        </div>
    </div>
    @if (session()->has('message'))
        <x-alert>
            {{ session('message') }}
        </x-alert>
    @endif
    @if (session()->has('error'))
        <div class="mt-4">
            <div class="rounded-lg p-3 bg-button">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Form to create or edit a product -->
    <div class="max-w-7xl mx-auto py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Product Details -->
                <div class="rounded-lg p-6 bg-primary">
                    <h2 class="text-2xl font-bold mb-2 text-primary-foreground">Product Details</h2>
                    <p class="text-foreground mb-6">Enter the basic information about your product</p>

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input wire:model.defer="name" id="name" type="text" class="w-full" placeholder="" />
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea wire:model.defer="description" id="description" rows="4" class="block w-full"
                                required></x-textarea>
                            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input wire:model.defer="price" id="price" type="number" min="0"
                                    class="block w-full" required />
                                @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <x-input-label for="discount" :value="__('Discount')" />
                                <x-text-input wire:model.defer="discount" id="discount" type="number" min="0"
                                    class="block w-full" />
                                @error('discount') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <x-input-label for="category" :value="__('Category')" />
                            <x-select-input wire:model.defer="categoryId" id="category" class="block w-1/2" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select-input>
                            @error('categoryId') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </div>

                <!-- Product Images -->
                @livewire('admin.products.product-images-form', ['images' => $images, 'productId' => $productId])


            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Product Status -->
                <div class="bg-primary rounded-lg p-6 shadow-lg">
                    <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Product Status</h2>
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <x-select-input wire:model.defer="status" id="status" class="block w-full">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </x-select-input>
                        </div>
                    </div>
                </div>

                @livewire('admin.products.size-variant-form', ['variants' => $variants])
            </div>
        </div>
    </div>

</div>
