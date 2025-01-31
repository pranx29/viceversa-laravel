<div class="bg-primary rounded-lg shadow-md">
    <div class="card-header p-4">
        <h2 class="text-2xl font-bold  text-primary-foreground">Addresses</h2>
        <p class="text-sm text-foreground">Manage your shipping addresses</p>
    </div>
    <div class="p-4 space-y-4">
        <!-- Existing Addresses -->
        @foreach($addresses as $address)
            <div class="bg-background text-primary-foreground p-4 rounded-md flex justify-between items-start">
                <div>
                    <p>{{ $address['street'] }}</p>
                    <p>{{ $address['city'] }}, {{ $address['postal_code'] }}</p>
                    <p>{{ $address['phone_number'] }}</p>
                </div>
                <div class="space-x-2">
                    <button wire:click="editAddress({{ $address['id'] }})"
                        class="rounded-md text-foreground hover:text-foreground/80 transition-all duration-300 p-2 bg-primary">
                        <x-iconsax-bro-edit class="size-5" />
                    </button>
                    <button wire:click="deleteAddress({{ $address['id'] }})"
                        class="rounded-md text-foreground hover:text-foreground/80 transition-all duration-300 p-2 bg-primary">
                        <x-iconsax-lin-trash class="size-5" />
                    </button>
                </div>
            </div>
        @endforeach
        @if(!$addresses)
            <div class="bg-background text-primary-foreground p-4 rounded-md">
                <p>No addresses added.</p>
            </div>
        @endif

        <!-- Add/Edit Address Form -->
        <form wire:submit.prevent="{{ $editingAddressId ? 'updateAddress' : 'addAddress' }}" class="space-y-4">
            <div class="space-y-2">
                <x-input-label for="street" :value="__('Street')" />
                <x-text-input wire:model.defer="address.street" id="street" type="text" class="w-full"
                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '')" />
                <x-input-error :messages="$errors->get('address.street')" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <x-input-label for="city" :value="__('City')" />
                    <x-text-input wire:model.defer="address.city" id="city" type="text" class="w-full"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
                    <x-input-error :messages="$errors->get('address.city')" />
                </div>
                <div class="space-y-2">
                    <x-input-label for="postalCode" :value="__('Postal Code')" />
                    <x-text-input wire:model.defer="address.postal_code" id="postalCode" type="text" class="w-full"
                        oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')" />
                    <x-input-error :messages="$errors->get('address.postal_code')" />
                </div>
            </div>
            <div class="space-y-2">
                <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                <x-text-input wire:model.defer="address.phone_number" id="phoneNumber" type="text" class="w-full"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                <x-input-error :messages="$errors->get('address.phone_number')" />
            </div>
            <div class="flex items-center gap-4">
                <x-primary-button>
                    {{ $editingAddressId ? 'Update Address' : 'Add Address' }}
                </x-primary-button>

                <x-action-message class="me-3" on="address-added">
                    {{ __('Address added.') }}
                </x-action-message>

                <x-action-message class="me-3" on="address-updated">
                    {{ __('Address updated.') }}
                </x-action-message>
            </div>
        </form>
    </div>
</div>
