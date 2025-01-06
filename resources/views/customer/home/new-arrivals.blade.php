<section>
    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <header>
            <h2 class="text-2xl font-bold text-primary-foreground sm:text-4xl">
                New Arrivals
            </h2>

            <p class="mt-4 max-w-md text-base text-foreground">
                Explore fresh additions to the Viceversa collection—crafted for the modern minimalist. From refined
                basics to statement pieces, our newest arrivals bring style and versatility to your everyday wardrobe.
            </p>
        </header>

        <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($newArrivalProducts as $product)
                <li>
                    <livewire:customer.products.product-card :product="$product" />
                </li>
            @endforeach
        </ul>
    </div>
</section>
