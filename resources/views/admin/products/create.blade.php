<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-16 min-h-screen">
            <!-- Heading and Back arrow to products -->
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.products.index') }}"
                    class="text-sm text-button transition hover:text-button/75">
                    <x-heroicon-o-arrow-left class="size-6" />
                </a>
                <h2 class="text-2xl font-bold text-primary-foreground sm:text-3xl">Create Product</h2>
            </div>

            <!-- Form to create a new product -->
            <div class="w-2/3 h-full">
                @livewire('product-form')
            </div>
        </div>

        
    </div>
</x-admin-layout>