<div class="container mx-auto px-4 py-8">
    <h1 class="font-bold text-primary-foreground text-4xl mb-8">Cart</h1>
    @if (collect($products)->isNotEmpty())
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                @foreach ($products as $index => $product)
                    @livewire('customer.cart.cart-item', ['product' => $product, 'index' => $index], key($index))
                @endforeach
            </div>

            <div class="lg:col-span-1">
                <div class="bg-primary p-6 rounded-lg shadow-lg h-full">
                    <h2 class="text-2xl font-bold mb-6 text-primary-foreground">Order Summary</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-foreground">Subtotal</span>
                            <span class="font-medium text-primary-foreground">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-foreground ">Shipping</span>
                            <span class="font-medium text-primary-foreground">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="border-t border-foreground my-4"></div>
                        <div class="flex justify-between text-primary-foreground">
                            <span class="text-xl font-bold">Total</span>
                            <span class="text-xl font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <button
                        class="bg-button text-black py-3 rounded-full transition-colors duration-300 hover:bg-opacity-80 inline-flex items-center justify-center gap-2 mt-8 w-full">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    @else
        <p class="text-center text-primary-foreground text-3xl font-bold">Your cart is currently empty.</p>
        <div class="text-center mt-1 ">
            <a href="" class="text-foreground underline hover:text-primary-foreground">Continue Shopping</a>
        </div>
    @endif
</div>