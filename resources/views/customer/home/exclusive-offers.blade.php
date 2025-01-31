<section>
    <div class="container mx-auto px-4 py-8">
        <header>
            <h2 class="text-2xl font-bold text-primary-foreground sm:text-4xl">
            Exclusive Offers
            </h2>

            <p class="mt-4 max-w-md text-base text-foreground">
            Discover exclusive offers at Viceversa—crafted for the modern minimalist. From refined basics to statement pieces, our exclusive deals bring style and versatility to your everyday wardrobe.
            </p>
        </header>

        <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($discountedProducts as $product)
                <li>
                    <livewire:customer.products.product-card :product="$product" />
                </li>
            @endforeach
        </ul>
    </div>
</section>
