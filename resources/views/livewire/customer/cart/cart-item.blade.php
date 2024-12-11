<div class="bg-primary rounded-lg overflow-hidden shadow-lg">
    <div class="flex items-center p-6">
        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-24 h-24 object-cover rounded-md">
        <div class="ml-6 flex-grow">
            <h2 class="text-xl font-semibold mb-1 text-primary-foreground">{{ $product['name'] }}</h2>
            <p class="text-foreground mb-2">Size: {{ $product['size']['name'] }}</p>
            <div class="flex items-center border border-primary-foreground w-fit rounded-md">
                <button wire:click="decrement" class="text-white w-8 h-8 flex items-center justify-center">-</button>
                <span class="mx-3 font-medium text-primary-foreground">{{ $product['quantity'] }}</span>
                <button wire:click="increment"
                    class="text-white w-8 h-8 rounded-md flex items-center justify-center">+</button>
            </div>
        </div>
        <div class="text-right">
            <p class="text-2xl font-bold mb-1 text-primary-foreground">${{ number_format($total, 2) }}</p>
            <button wire:click="remove"
                class="text-red-500 text-sm mt-4 hover:text-red-600 transition duration-300 ease-in-out">Remove</button>
        </div>
    </div>
</div>