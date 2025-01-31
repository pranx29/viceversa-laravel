<div class="bg-primary rounded-lg overflow-hidden shadow-lg">
    <div class="flex items-center p-6">
        <img src="{{ $image }}" alt="{{ $productName }}" class="w-24 h-28 object-cover rounded-md">
        <div class="ml-6 flex-grow">
            <h2 class="text-xl font-semibold mb-1 text-primary-foreground">{{ $productName }}</h2>
            <p class="text-foreground">Size: {{ $size }}</p>

            @if($discount)
                <p class="text-sm text-primary-foreground mb-2">Price: LKR {{ number_format($price - $discount, 2) }} <span
                        class="text-sm text-foreground line-through">LKR {{ number_format($price, 2) }}</span></p>
            @else
                <p class="text-sm text-primary-foreground mb-2">Price: LKR {{ number_format($price, 2) }}</p>
            @endif
            <div class="flex items-center border border-primary-foreground w-fit rounded-md">
                <button wire:click="decrement" class="text-white w-8 h-8 flex items-center justify-center">-</button>
                <span class="mx-3 font-medium text-primary-foreground">{{ $quantity }}</span>
                <button wire:click="increment"
                    class="text-white w-8 h-8 rounded-md flex items-center justify-center">+</button>
            </div>
        </div>
        <div class="text-right">
            @if ($discount)
                <p class="text-2xl font-bold mb-1 text-primary-foreground">LKR {{ number_format(($price - $discount) * $quantity, 2) }}
                </p>

            @else
                <p class="text-2xl font-bold mb-1 text-primary-foreground">LKR {{ number_format($price * $quantity, 2) }}
                </p>
            @endif
            <button wire:click="remove">
                <x-iconsax-lin-trash
                    class="text-foreground text-sm hover:text-foreground/80 transition duration-300 ease-in-out size-4" />
            </button>
        </div>
    </div>
</div>
