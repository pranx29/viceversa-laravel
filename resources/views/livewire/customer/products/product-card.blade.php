<li>
    <a class="group block overflow-hidden rounded-lg" href="{{ route('product.show', ['slug' => $product->slug]) }}">
        <div class="relative h-[350px] sm:h-[450px]">
            <img src="{{ $product->primaryImage() }}" alt="{{ $product->name }}"
                class="absolute inset-0 h-full w-full object-cover opacity-100 group-hover:opacity-0" />

            <img src="{{ $product->secondaryImage()}}" alt="{{ $product->name }}"
                class="absolute inset-0 h-full w-full object-cover opacity-0 group-hover:opacity-100" />
        </div>

        <div class="relative bg-primary p-3">
            <div class="mt-1.5 flex items-center justify-between text-primary-foreground">
                <h3 class="text-base group-hover:underline group-hover:underline-offset-4">
                    {{ $product->name }}
                </h3>
                <p class="tracking-wide">LKR {{ number_format($product->price, 2) }}</p>
            </div>

            <div class="mt-1.5 flex items-center justify-between text-foreground">

                <p class="tracking-wide text-xs capitalize">
                    {{ $product->category->name }}
                </p>

                <p class="text-xs uppercase tracking-wide"> {{ $product->sizes->count()}} Sizes</p>
            </div>
        </div>
    </a>
</li>