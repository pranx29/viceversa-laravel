<li>
    <a class="group block overflow-hidden rounded-lg">
        <!-- Product Images (static + hover effect) -->
        <div class="relative h-[350px] sm:h-[450px]">
            <img src="{{ $product->primaryImage() }}" alt="{{ $product->name }}"
                class="absolute inset-0 h-full w-full object-cover opacity-100 group-hover:opacity-0" />

            <img src="{{ $product->hoverImage() }}" alt="{{ $product->name }}"
                class="absolute inset-0 h-full w-full object-cover opacity-0 group-hover:opacity-100" />
        </div>

        <!-- Product Details (name, price, colors, etc.) -->
        <div class="relative bg-primary p-3">
            <div class="mt-1.5 flex items-center justify-between text-primary-foreground">
                <h3 class="text-base group-hover:underline group-hover:underline-offset-4">
                    {{ $product->name }}
                </h3>
                <p class="tracking-wide">LKR {{ number_format($product->price, 2) }}</p>
            </div>

            <div class="mt-1.5 flex items-center justify-between text-foreground">
                <!-- Display first color name or a fallback if none exists -->
                <p class="tracking-wide text-xs capitalize">{{ $product->variants->first()->color->name }}
                </p>

                <p class="text-xs uppercase tracking-wide">{{ $product->variants->count() }} Colors</p>
            </div>
        </div>
    </a>
</li>