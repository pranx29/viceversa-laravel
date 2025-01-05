<div class="container mx-auto px-4 py-8">
    <h1 class="font-bold text-primary-foreground text-4xl mb-8">Checkout</h1>
    @if (session()->has('error'))
        <script>
            window.scrollTo({ top: 0, behavior: 'smooth' });
        </script>
        <div class="mt-4">
            <div class="rounded-lg p-3 bg-button">
                {{ session('error') }}
            </div>
        </div>
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Main Content -->
        <div class="space-y-8">
            <!-- Header Section -->

            @if (Auth::check())
                <div class="bg-primary shadow rounded-lg p-6 space-y-4">
                    <p class="font-semibold text-primary-foreground">Account</p>
                    <p class="text-foreground">{{ Auth::user()->email }}</p>
                </div>

                <div class="bg-primary shadow rounded-lg p-6 flex flex-col space-y-4">
                    <p class="font-semibold text-primary-foreground">Ship to</p>

                    <!-- List addresses as radio button -->
                    <div class="space-y-4">
                        @foreach (Auth::user()->addresses as $address)
                            <label class="flex items-center space-x-4">
                                <input type="radio" name="address" wire:model="selectedAddress"
                                    value="{{ $address['id'] }}" class=" h-5 w-5 rounded-full bg-background border-border text-primary shadow-sm focus:ring-primary">
                                <div>
                                    <p class="text-primary-foreground">{{ $address['street'] }}</p>
                                    <p class="text-foreground">{{ $address['city'] }}, {{$address['postal_code']}} | +94 {{$address['phone_number']}}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <!-- Add new address -->
                    <a href="{{ route('profile') }}" class="text-primary-foreground hover:text-foreground transition-all duration-300 text-start">
                        Add new address
                    </a>
                </div>
            @else
                <div class=" bg-primary shadow rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Contact</h2>
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model.defer="email" id="email" type="email" class="w-full"
                                oninput="this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '')" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-foreground">Already have an account?</span>
                            <a href="{{ route('login') }}"
                                class="text-primary-foreground underline hover:text-foreground transition-all duration-300">Login</a>
                        </div>
                    </div>
                </div>

            <!-- Shipping Information -->
            <div class="bg-primary shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Shipping</h2>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="firstName" :value="__('First Name')" />
                            <x-text-input wire:model.defer="firstName" id="firstName" type="text" class="w-full"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                            <x-input-error :messages="$errors->get('firstName')" />
                        </div>
                        <div>
                            <x-input-label for="lastName" :value="__('Last Name')" />
                            <x-text-input wire:model.defer="lastName" id="lastName" type="text" class="w-full"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                            <x-input-error :messages="$errors->get('lastName')" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input wire:model.defer="address" id="address" type="text" class="w-full"
                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s,.-]/g, '')" />
                        <x-input-error :messages="$errors->get('address')" />
                    </div>
                    <div>
                        <x-input-label for="city" :value="__('City')" />
                        <x-text-input wire:model.defer="city" id="city" type="text" class="w-full"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                        <x-input-error :messages="$errors->get('city')" />
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Phone Number')" />
                        <x-text-input wire:model.defer="phone" id="phone" type="tel" class="w-full"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                        <x-input-error :messages="$errors->get('phone')" />
                    </div>
                </div>
            </div>
            @endif


            <!-- Payment Section -->
            <div class="bg-primary shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Payment</h2>
                <div class="space-y-4">
                    <div>
                        <x-input-label for="cardNumber" :value="__('Card Number')" />
                        <x-text-input wire:model.defer="cardNumber" id="cardNumber" type="text" class="w-full"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                        <x-input-error :messages="$errors->get('cardNumber')" />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="expiryDate" :value="__('Expiry Date')" />
                            <x-text-input wire:model.defer="expiryDate" id="expiryDate" type="text" class="w-full"
                                oninput="this.value = this.value.replace(/[^0-9\/]/g, '').slice(0, 5); if (this.value.length === 2 && !this.value.includes('/')) this.value += '/';" />
                            <x-input-error :messages="$errors->get('expiryDate')" />
                        </div>
                        <div>
                            <x-input-label for="cvv" :value="__('CVV')" />
                            <x-text-input wire:model.defer="cvv" id="cvv" type="text" class="w-full" maxlength="3"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);" />
                            <x-input-error :messages="$errors->get('cvv')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div>
            <div class="bg-primary shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-primary-foreground">Order Summary</h2>
                <div class="space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="flex items-center justify-between space-x-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                    class="w-16 h-20 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold text-primary-foreground">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-foreground"> <span>{{ $item['size']['name'] }}</span> |
                                        {{$item['quantity']}}
                                    </p>
                                </div>
                            </div>
                            <p class="font-medium text-primary-foreground">LKR
                                {{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>
                    @endforeach

                    <!-- Cost Summary -->
                    <div class="border-t pt-4 space-y-2 text-primary-foreground">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>LKR
                                {{ number_format(collect($cartItems)->sum(function ($item) {
    return $item['price'] * $item['quantity']; }), 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>LKR {{ number_format($shippingCost, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-semibold">
                            <span>Total</span>
                            <span>LKR {{ number_format($totalAmount + $shippingCost, 2) }}</span>
                        </div>
                    </div>

                    <x-primary-button class="w-full" wire:click="placeOrder">
                        {{ __('Place Order') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Livewire.on('scrollToTop', () => {
        window.scrollTo({ bottom: 0, behavior: 'smooth' });
    });
</script>
