<section id="best-sellers">
    <div class="container mx-auto px-4 py-8">
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
            @foreach ($bestSellerProducts as $product)
                <li>
                    <livewire:customer.products.product-card :product="$product" />
                </li>
            @endforeach
        </ul>
    </div>
</section>
