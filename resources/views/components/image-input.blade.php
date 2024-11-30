@props(['key'])
<div x-data="{
        imageUrl: null, // Store the image URL for preview
        openFileDialog() {
            $refs.fileInput.click(); 
        },
        handleFileUpload(event, key) {
            const file = event.target.files[0];
            if (file) {
                this.imageUrl = URL.createObjectURL(file); 
            }
        }
    }" class="relative inline-block">

    <input type="file" x-ref="fileInput" class="hidden" wire:model="images.{{ $key }}"
        @change="handleFileUpload($event, {{ $key }})"/>

    <button type="button" @click="openFileDialog" {{ $attributes->merge(['class' => 'shrink-0 rounded-lg bg-primary text-foreground hover:text-black hover:bg-button p-0.5 text-sm font-medium w-20 h-28 flex items-center justify-center']) }}>

        <template x-if="imageUrl">
            <img :src="imageUrl" alt="Uploaded image" class="w-full h-full object-cover rounded-lg" />
        </template>
        <template x-if="!imageUrl">
            <x-heroicon-o-photo class="size-8" />
        </template>
    </button>
</div>