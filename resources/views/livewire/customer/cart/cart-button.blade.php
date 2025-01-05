<div>
    <!-- Cart Button -->

    <div class="relative">
        <!-- Cart Button -->
        <button
            class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-md bg-primary p-2 relative"
            wire:click.prevent="showCart">
            <x-iconsax-bro-shopping-cart class="w-6 h-6" />
        </button>

        <!-- Product Count Badge -->
        @if ($cartCount > 0)
            <span
                class="absolute -top-1 -right-1 bg-foreground text-xs font-bold rounded-md w-5 h-5 flex items-center justify-center">
                {{ $cartCount }}
            </span>
        @endif


    </div>


</div>