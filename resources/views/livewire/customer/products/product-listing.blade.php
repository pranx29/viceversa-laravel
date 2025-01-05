<div>
    <div class="flex justify-between items-center mb-4">
        <p class="text-foreground"> {{ count($products)}} products found</p>
        <div class="relative">
            <x-select-input wire:model.defer="sortOption" id="sort">
                <option value="">Sort by</option>
                <option value="featured">Featured</option>
                <option value="priceLowToHigh">Price: Low to High</option>
                <option value="priceHighToLow">Price: High to Low</option>
                <option value="nameAZ">Name: A to Z</option>
                <option value="nameZA">Name: Z to A</option>
            </x-select-input>

        </div>


    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <livewire:customer.products.product-card :product="$product" :showAddToCart="true" />
        @endforeach
    </div>
</div>