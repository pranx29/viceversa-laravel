<div>
    <!-- Cart Button -->

    <div class="relative">
        <!-- Cart Button -->
        <button
            class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-full bg-primary p-2 relative"
            wire:click.prevent="showCart">
            <x-heroicon-o-shopping-cart class="w-6 h-6" />
        </button>

        <!-- Product Count Badge -->
        @if ($cartCount > 0)
            <span
                class="absolute top-0 right-0 bg-foreground text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                {{ $cartCount }}
            </span>
        @endif
    </div>


</div>
