<div class="group block overflow-hidden rounded-lg">
    <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
        <div class="relative h-[350px]">
            <img src="{{ $product->primaryImage() }}" alt="{{ $product->name }}"
                class="absolute inset-0 h-full w-full object-cover opacity-100 group-hover:opacity-0" />

            <img src="{{ $product->secondaryImage()}}" alt="{{ $product->name }}"
                class="absolute inset-0 h-full w-full object-cover opacity-0 group-hover:opacity-100" />
        </div>

        <div class="relative bg-primary p-3">
            <div class="mt-1.5 flex items-center justify-between text-primary-foreground">
                <h3 class="text-base group-hover:underline group-hover:underline-offset-4 w-1/2 truncate">
                    {{ $product->name }}
                </h3>
                <p class="tracking-wide whitespace-nowrap">LKR {{ number_format($product->price, 2) }}</p>
            </div>
            @if(!$showAddToCart)
                <div class="mt-1.5 flex items-center justify-between text-foreground">

                    <p class="tracking-wide text-xs capitalize">
                        {{ $product->category->name }}
                    </p>

                    <p class="text-xs uppercase tracking-wide"> {{ $product->sizes->count()}} Sizes</p>
                </div>
            @endif
    </a>

    @if($showAddToCart)
        <div class="mt-1.5 flex flex-col justify-between text-foreground gap-2">
            <p class="tracking-wide text-xs capitalize">
                {{ $product->category->name }}
            </p>

            <div class="mt-1 flex select-none flex-wrap items-center space-x-2">
                @foreach ($product->sizes as $size)
                    <label>
                        <input type="radio" wire:click="selectSize('{{ $size->id }}')" class="peer sr-only" name="size"
                            value="{{ $size->id }}" {{ $selectedSize == $size->id ? 'checked' : '' }} />
                        <p
                            class="peer-checked:bg-white peer-checked:text-black text-primary-foreground rounded-lg border border-button px-2 font-bold">
                            {{ $size->name }}
                        </p>
                    </label>
                @endforeach
            </div>

            <x-primary-button wire:click="addToCart" class="inline-flex items-center justify-center gap-2 px-6 py-2 mt-4">
                <x-iconsax-bro-shopping-cart class="h-5 w-5" />
                Add to cart
            </x-primary-button>
        </div>
    @endif
</div>
