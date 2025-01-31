<section>
    <div class="container mx-auto px-4">
        <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
            <!-- Product Images -->
            <div class="lg:col-span-3 lg:row-end-1">
                <div class="lg:flex lg:items-start">
                    <div class="lg:order-2">
                        <div class="max-w-xl overflow-hidden rounded-lg">
                            <img class="h-full w-full max-w-full object-cover"
                                src="{{ $selectedImage }}"
                                alt="Selected Product Image" />
                        </div>
                    </div>

                    <div class="w-full lg:order-1 lg:w-24 lg:flex-shrink-0 lg:mt-0 mt-2">
                        <div class="flex flex-row items-start lg:flex-col gap-2">
                            @foreach ($product->images as $image)
                                <button type="button"
                                    wire:click="selectImage('{{ $image->path }}')"
                                    class="flex-0 h-28 overflow-hidden rounded-lg border-2 {{ $selectedImage === $image->path ? 'border-primary-foreground' : 'border-transparent' }} text-center">
                                    <img class="h-full w-full object-cover p-0.5 rounded-lg"
                                        src="{{ $image->path }}" alt="Product Thumbnail" />
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
                <h1 class="text-2xl font-bold text-primary-foreground sm:text-3xl">{{ $product->name }}</h1>
                <p class="mt-2 text-foreground text-sm">{{ $product->category->name }}</p>
                <p class="mt-4 text-primary-foreground">{{ $product->description }}</p>

                <h2 class="mt-4 text-base text-primary-foreground">Size</h2>
                <div class="mt-1 flex select-none flex-wrap items-center space-x-2">
                    @foreach ($product->sizes as $size)
                        <label>
                            <input type="radio" wire:click="selectSize('{{ $size->id }}')" class="peer sr-only"
                                name="size" value="{{ $size->id }}" {{ $selectedSize == $size->id ? 'checked' : '' }} />
                            <p class="peer-checked:bg-white peer-checked:text-black text-primary-foreground rounded-lg border border-button px-6 py-2 font-bold">
                                {{ $size->name }}
                            </p>
                        </label>
                    @endforeach
                </div>

                <div
                    class="mt-10 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
                    <div class="flex items-end">
                        @if ($product->discount)
                            <h1 class="text-3xl font-bold text-primary-foreground">LKR {{ number_format($product->price - $product->discount, 2) }}</h1>
                            <span class="ml-2 text-lg text-foreground line-through">LKR {{ number_format($product->price, 2) }}</span>
                        @else
                            <h1 class="text-3xl font-bold text-primary-foreground">LKR {{ number_format($product->price, 2) }}</h1>
                        @endif
                    </div>

                    <x-primary-button wire:click="addToCart" class="inline-flex items-center justify-center gap-2 px-6 py-2">
                    <x-iconsax-bro-shopping-cart class="h-5 w-5" />
                        Add to cart
                    </x-primary-button>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
