<section>
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <header>
            <h2 class="text-2xl font-bold text-primary-foreground sm:text-4xl">
                Best Sellers
            </h2>

            <p class="mt-4 max-w-md text-base text-foreground">
                Discover our top picks—sleek, timeless pieces that blend style and simplicity. Perfect for the modern
                minimalist, these essentials elevate your everyday look with ease.
            </p>
        </header>

        <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </ul>
    </div>
</section>