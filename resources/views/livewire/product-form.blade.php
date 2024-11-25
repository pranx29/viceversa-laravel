<div>
    <form wire:submit.prevent="submit" class="space-y-4 mt-8">
        @if(session()->has('message'))
            <x-alert type="success" title="Product Added" class="mt-4">
                {{ session('message') }}
            </x-alert>
        @endif
        @csrf
        <div class="grid grid-cols-1 space-y-8">
            <!-- Product Details -->
            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model.defer="name" id="name" type="text" class="block w-full mt-1" required
                        autofocus />
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea wire:model.defer="description" id="description" rows="4" class="block w-full mt-1"
                        required></x-textarea>
                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <x-select-input wire:model.defer="category_id" id="category" class="block w-full mt-1" required>
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select-input>
                    @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex space-x-4">
                    <div class="w-1/2">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input wire:model.defer="price" id="price" type="number" min="0"
                            class="block w-full mt-1" required />
                        @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="discount" :value="__('Discount')" />
                        <x-text-input wire:model.defer="discount" id="discount" type="number" min="0"
                            class="block w-full mt-1" required />
                        @error('discount') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="w-1/2">
                    <x-input-label for="status" :value="__('Status')" />
                    <x-select-input wire:model.defer="status" id="status" class="block w-full mt-1" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-select-input>
                    @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Variants Section -->
            <div class="space-y-4" wire:key="variant-section">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-foreground">Variants</h3>
                    <button type="button" class="text-sm text-button transition hover:text-button/75"
                        wire:click="addVariant">Add Variant</button>
                </div>

                @if(!empty($variants))
                    <div class="max-h-64 overflow-y-auto">

                        <table class="min-w-full table-auto border-separate border-spacing-4">
                            <thead>
                                <tr>
                                    <th class="text-left text-sm font-medium text-foreground">Color</th>
                                    <th class="text-left text-sm font-medium text-foreground">Size</th>
                                    <th class="text-left text-sm font-medium text-foreground">Stock</th>
                                    <th class="text-left text-sm font-medium text-foreground">Images</th>
                                    <th class="text-left text-sm font-medium text-foreground">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($variants as $index => $variant)
                                    <tr>
                                        <td class="w-1/3">
                                            <x-select-input wire:model.defer="variants.{{ $index }}.color"
                                                class="block w-full mt-1" required>
                                                <option value="">Select a color</option>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach
                                            </x-select-input>
                                            @error("variants.{$index}.color") <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="w-1/7">
                                            <x-select-input wire:model.defer="variants.{{ $index }}.size"
                                                class="block w-full mt-1" required>
                                                <option value="">Select a size</option>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size }}">{{ $size }}</option>
                                                @endforeach
                                            </x-select-input>
                                            @error("variants.{$index}.size") <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="w-1/6">
                                            <x-text-input wire:model.defer="variants.{{ $index }}.stock" type="number"
                                                class="block w-full mt-1" required />
                                            @error("variants.{$index}.stock") <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td class="w-1/2 flex gap-2">
                                            <div x-data="{ 
                                                                                                                                                                                                                                                                                                                        openFileDialog() { 
                                                                                                                                                                                                                                                                                                                            $refs.fileInput.click() 
                                                                                                                                                                                                                                                                                                                        },
                                                                                                                                                                                                                                                                                                                        imageUrl: null, // Store the image URL
                                                                                                                                                                                                                                                                                                                        handleFileUpload(event) { 
                                                                                                                                                                                                                                                                                                                            const file = event.target.files[0];
                                                                                                                                                                                                                                                                                                                            if (file) {
                                                                                                                                                                                                                                                                                                                                this.imageUrl = URL.createObjectURL(file); // Set the image URL
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    }"
                                                class="relative inline-block">

                                                <!-- Hidden file input -->
                                                <input type="file" wire:model="variants.{{ $index }}.image1" x-ref="fileInput"
                                                    class="hidden" @change="handleFileUpload($event)" />

                                                <!-- Button to trigger file input, shows icon or image -->
                                                <button type="button" @click="openFileDialog"
                                                    class="shrink-0 rounded-lg bg-primary text-foreground hover:text-black hover:bg-button p-0.5 text-sm font-medium w-16 h-16 flex items-center justify-center">

                                                    <!-- Show image if available, else show icon -->
                                                    <template x-if="imageUrl">
                                                        <img :src="imageUrl" alt="Uploaded image"
                                                            class="w-full h-full object-cover rounded-lg" />
                                                    </template>
                                                    <template x-if="!imageUrl">
                                                        <x-heroicon-o-photo class="size-7" />
                                                    </template>
                                                </button>

                                                <!-- Error message display -->
                                                @error("variants.{{ $index }}.image1")
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div x-data="{ 
                                                                                                                                                                                                                                                                                                                        openFileDialog() { 
                                                                                                                                                                                                                                                                                                                            $refs.fileInput2.click() 
                                                                                                                                                                                                                                                                                                                        },
                                                                                                                                                                                                                                                                                                                        imageUrl2: null, // Store the image URL
                                                                                                                                                                                                                                                                                                                        handleFileUpload(event) { 
                                                                                                                                                                                                                                                                                                                            const file = event.target.files[0];
                                                                                                                                                                                                                                                                                                                            if (file) {
                                                                                                                                                                                                                                                                                                                                this.imageUrl2 = URL.createObjectURL(file); // Set the image URL
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                    }"
                                                class="relative inline-block">

                                                <!-- Hidden file input -->
                                                <input type="file" wire:model="variants.{{ $index }}.image2" x-ref="fileInput2"
                                                    class="hidden" @change="handleFileUpload($event)" />

                                                <!-- Button to trigger file input, shows icon or image -->
                                                <button type="button" @click="openFileDialog"
                                                    class="shrink-0 rounded-lg bg-primary text-foreground hover:text-black hover:bg-button p-0.5 text-sm font-medium w-16 h-16 flex items-center justify-center">

                                                    <!-- Show image if available, else show icon -->
                                                    <template x-if="imageUrl2">
                                                        <img :src="imageUrl2" alt="Uploaded image"
                                                            class="w-full h-full object-cover rounded-lg" />
                                                    </template>
                                                    <template x-if="!imageUrl2">
                                                        <x-heroicon-o-photo class="size-7" />
                                                    </template>
                                                </button>

                                                <!-- Error message display -->
                                                @error("variants.{{ $index }}.image2")
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </td>
                                        <td class="w-1/7">
                                            <button type="button" wire:click="removeVariant({{ $index }})"
                                                class="shrink-0 rounded-lg text-foreground hover:text-foreground/80 p-2 text-sm font-medium">
                                                <x-heroicon-o-x-mark class="size-7" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <x-primary-button type="submit" class="rounded-lg">
                Save
            </x-primary-button>
        </div>
    </form>
</div>