<div class="container mx-auto px-4 py-8">
    <h1 class="font-bold text-primary-foreground text-4xl mb-8">Cart</h1>
    @if (collect($cartItems)->isNotEmpty())
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                @foreach ($cartItems as $index => $item)
                    @livewire('customer.cart.cart-item', ['item' => $item, 'index' => $index], key($index))
                @endforeach
            </div>

            <div class="lg:col-span-1">
                <div class="bg-primary p-6 rounded-lg shadow-lg h-full">
                    <h2 class="text-2xl font-bold mb-6 text-primary-foreground">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-foreground">Subtotal</span>
                            <span class="font-medium text-primary-foreground">LKR {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-foreground ">Shipping</span>
                            <span class="font-medium text-primary-foreground">LKR {{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="border-t border-foreground my-4"></div>
                        <div class="flex justify-between text-primary-foreground">
                            <span class="text-xl font-bold">Total</span>
                            <span class="text-xl font-bold">LKR {{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <x-primary-button class="w-full mt-4" wire:click="checkout">
                        {{ __('Proceed to Checkout') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-foreground text-3xl font-bold">Your cart is currently empty.</p>
        <div class="text-center mt-1 ">
            <a href="/" class="text-primary-foreground underline hover:text-foreground transition-all duration-300">Continue Shopping</a>
        </div>
    @endif
</div>
