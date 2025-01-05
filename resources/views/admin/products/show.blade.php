<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-16 min-h-screen">
            <!-- Heading and Back arrow to products -->
            <div class="flex items-center gap-4 justify-between">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="text-sm text-button transition hover:text-button/75">
                        <x-iconsax-bro-arrow-left-1 class="size-6" />
                    </a>
                    <h2 class="text-2xl font-bold text-primary-foreground sm:text-3xl">{{$product->name}}</h2>
                </div>

                <div class="flex gap-4">
                    <button
                        class="rounded-lg bg-primary text-foreground px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                        Discard
                    </button>
                    <button wire:click="edit"
                        class="rounded-lg bg-button px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                        Edit
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
        </div>
    </div>
</x-admin-layout>
