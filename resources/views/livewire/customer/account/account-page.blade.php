<div class="container mx-auto px-4 py-8">
    <h1 class="font-bold text-primary-foreground text-4xl mb-8">My Account</h1>

    <!-- Tab Navigation -->
    <div class="mb-4">
        <ul class="flex gap-2">
            <li>
                <a wire:click.prevent="switchTab('profile')"
                    class="inline-block py-2 px-4 font-semibold rounded-md {{ $activeTab === 'profile' ? 'bg-white' : 'bg-primary text-foreground' }}">
                    Profile
                </a>
            </li>
            <li>
                <a wire:click.prevent="switchTab('orders')"
                    class="inline-block py-2 px-4 font-semibold rounded-md {{ $activeTab === 'orders' ? 'bg-white' : 'bg-primary text-foreground' }}">
                    Orders
                </a>
            </li>

            <li class="ml-auto">
                <button
                    class="text-primary-foreground inline-flex items-center justify-center gap-2 px-6 py-2 hover:text-opacity-80 transition-all duration-300"
                    wire:click="logout">
                    Logout
                    <x-iconsax-bro-logout class="h-5 w-5" />
                </button>
            </li>

        </ul>
    </div>

    <!-- Tab Content -->
    @if ($activeTab === 'profile')
        <div id="profile" class="space-y-6">
            <!-- Profile Content -->
            <livewire:customer.account.basic-information />

            <!-- Change Password -->
            <livewire:customer.account.change-password />

            <!-- Address Book -->
            <livewire:customer.account.addresses />
        </div>
    @elseif ($activeTab === 'orders')
        <livewire:customer.account.orders />
    @endif
</div>
