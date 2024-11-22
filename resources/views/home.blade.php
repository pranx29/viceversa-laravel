<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-20">
        <div class="flex items-center justify-center">
            <section class="text-center w-full max-w-4xl py-20">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">
                    <span class="font-black text-foreground">Style Redefined:</span>
                    Trendy Fashion for Every Wardrobe
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-foreground mt-5 font-semibold">
                    Discover the perfect blend of contemporary trends and timeless style.
                    From everyday essentials to standout pieces, our collection elevates
                    your wardrobe with versatile, fashionable options. Explore our best
                    sellers and new arrivals to redefine your look today!
                </p>
                <a href="#best-sellers"
                    class="bg-white text-black px-5 py-3 rounded-full mt-10 transition-colors duration-300 inline-flex items-center justify-center hover:bg-opacity-80">
                    <span class="text-sm sm:text-base md:text-xl mr-3">EXPLORE COLLECTIONS</span>
                    <x-heroicon-o-arrow-down-circle class="w-6 h-6" />
                </a>
            </section>
        </div>
    </div>
</x-app-layout>