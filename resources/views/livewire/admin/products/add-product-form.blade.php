<div>
    <form wire:submit.prevent="submit" class="space-y-4 mt-8">
        @if(session()->has('message'))
            <x-alert type="success" title="Product Added" class="mt-4">
                {{ session('message') }}
            </x-alert>
        @elseif(session()->has('error'))
            <x-alert type="error" title="Error" class="mt-4">
                {{ session('error') }}
            </x-alert>
        @endif
        @csrf
        <div class="grid grid-cols-1 space-y-8">
            <!-- Product Details -->
            <div class="space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model.defer="name" id="name" type="text" class="block w-full mt-1" placeholder=""
                        required autofocus />
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
                            class="block w-full mt-1" />
                        @error('discount') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="w-1/2">
                    <x-input-label for="status" :value="__('Status')" />
                    <x-select-input wire:model.defer="status" id="status" class="block mt-1 w-full" required>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </x-select-input>
                    @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Size variants -->
            <div>
                <x-input-label for="sizes" :value="__('Sizes')" />
                <div class="flex flex-col gap-4 mt-1">
                    @foreach($sizes as $size)
                        <div class="flex items-center gap-2">
                            <input type="checkbox" wire:model.defer="size_ids" value="{{ $size->id }}"
                                id="size{{ $size->id }}"
                                class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary cursor-pointer transition-all checked:border-border" />
                            <x-input-label for="size{{ $size->id }}" :value="$size->name" class="w-8" />
                            <x-text-input type="number" wire:model.defer="size_quantities.{{ $size->id }}"
                                id="quantity{{ $size->id }}" min="0" class="block w-20 mt-1" />
                        </div>
                    @endforeach
                </div>

                @error('size_ids') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
                @error('size_quantities') <span class="text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>



            <!-- Product Images -->
            <div>
                <x-input-label for="images" :value="__('Product Images')" />
                <div class="flex gap-4">
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="flex flex-col items-center justify-center">
                            <x-image-input key="{{ $i }}" id="image{{ $i }}" class="block my-1" />
                            <x-input-label for="image{{ $i }}" :value="$i" />
                        </div>
                    @endfor
                </div>
                @error('images')
                    <span class="text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <x-primary-button type="submit" class="rounded-lg">
                    Save
                </x-primary-button>
            </div>
    </form>
</div>