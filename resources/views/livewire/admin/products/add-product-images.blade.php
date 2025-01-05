<div class="bg-primary rounded-lg p-6 shadow-lg">
    <h2 class="text-2xl font-bold mb-2 text-primary-foreground">Product Images</h2>
    <p class="text-foreground mb-6">Add images to your product gallery (Maximum: 6)</p>

    <div class="space-y-4">
        {{-- Image Selection --}}
        @if (count($images) < $maxImages)
            <div class="border-2 border-dashed border-secondary rounded-lg p-8 text-center" x-data
                x-on:click="$refs.fileInput.click()">
                <div class="mx-auto w-12 h-12 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-foreground">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <circle cx="8.5" cy="8.5" r="1.5" />
                        <polyline points="21 15 16 10 5 21" />
                    </svg>
                </div>
                <div class="text-sm text-foreground">
                    Drag and drop your images here, or click to browse
                </div>
                <input type="file" class="hidden" multiple wire:model="images" x-ref="fileInput" />
            </div>
        @else
            <div class="text-sm text-red-500 text-center">Maximum of 6 images selected.</div>
        @endif

        {{-- Image Previews --}}
        <div class="grid grid-cols-3 gap-4">
            @foreach ($images as $index => $image)
                <div class="aspect-square bg-secondary rounded-lg relative group">
                    <img src="{{ $image->temporaryUrl() }}" alt="Product Image {{ $index + 1 }}"
                        class="w-full h-full object-cover rounded-lg">
                    <div
                        class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <input type="number" value="{{ $index + 1 }}" min="1" max="{{ count($images) }}"
                            class="w-16 px-2 py-1 bg-white text-black rounded-md text-center"
                            wire:change="updateImageOrder({{ $index }}, $event.target.value)">
                    </div>
                    <button wire:click="removeImage({{ $index }})"
                        class="absolute top-2 right-2 bg-red-500 text-white rounded-md w-6 h-6 flex items-center justify-center">
                        &times;
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
