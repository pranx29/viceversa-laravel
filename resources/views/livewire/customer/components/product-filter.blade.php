<div class="bg-primary shadow rounded-lg p-4">
    <div class="flex items-center justify-between mb-4 text-primary-foreground">
        <div class="flex items-center">
            <x-iconsax-bol-filter class="mr-2 h-5 w-5" />
            <h3 class="text-2xl font-medium">Filters</h3>
        </div>
        <x-primary-button wire:click="resetFilters" class="text-sm px-2 py-1">
            Reset
        </x-primary-button>
    </div>
    <div class="space-y-6">
        <!-- Search -->
        <div>
            <label for="search" class="block text-sm font-medium text-primary-foreground">Search</label>
            <div class="relative mt-2">
                <input type="text" id="search" wire:model.live="searchTerm" placeholder="Search products..."
                    class="pl-10 border-foreground bg-background block w-full sm:text-sm rounded-md placeholder:text-foreground text-primary-foreground focus:ring-primary-foreground focus:border-primary-foreground" />
                <x-iconsax-bro-search-normal class="absolute left-3 top-2.5 h-5 w-5 text-primary-foreground" />
            </div>
        </div>

        <!-- Categories -->
        <div>
            <label class="block text-sm font-medium text-primary-foreground">Category</label>
            <div class="space-y-2 mt-2">

                @foreach ($categories as $category)
                    <div class="flex items-center">
                        <input type="checkbox" id="category-{{ $category->id }}" value="{{ $category->id }}"
                            wire:model.live="selectedCategories"
                            class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary focus:border-primary checked:bg-background" />
                        <label for="category-{{ $category->id }}" class="ml-2 text-sm text-foreground">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Sizes -->
        <div>
            <label class="block text-sm font-medium text-primary-foreground">Size</label>
            <div class="space-y-2 mt-2">
                @foreach ($sizes as $size)
                    <div class="flex items-center">
                        <input type="checkbox" id="size-{{ $size->id }}" value="{{ $size->id }}"
                            wire:model.live="selectedSizes"
                            class="rounded bg-background border-border text-primary shadow-sm focus:ring-primary focus:border-primary checked:bg-background" />
                        <label for="size-{{ $size->id }}" class="ml-2 text-sm text-foreground">
                            {{ $size->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Price Range -->
        <div>
            <label class="block text-sm font-medium text-primary-foreground">Price Range</label>
            <div class="mt-2">
                <input type="range" min="{{$priceRange[0]}}" max="{{$priceRange[1]}}"
                    wire:model.live="selectedPriceRange.1" class="w-full" style="accent-color: #FFFFFF;" />
                <div class="flex justify-between text-sm text-foreground mt-1">
                    <span>LKR {{ $priceRange[0] }}</span>

                    @if ($selectedPriceRange[1] != $priceRange[0] && $selectedPriceRange[1] != $priceRange[1])
                        <span class="px-2 bg-button rounded text-black">LKR {{ $selectedPriceRange[1] }}</span>
                    @endif

                    <span>LKR {{ $priceRange[1] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
