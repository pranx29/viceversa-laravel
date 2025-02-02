<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header>
    <div class="container mx-auto px-4 py-8">
        <div class="flex h-16 items-center justify-between">
            <div class="md:flex md:items-center md:gap-12">
                <a class="block text-teal-600" href="#">
                    <span class="sr-only">Viceversa</span>
                    <x-application-logo class="w-20 h-20" />
                </a>
            </div>

            <div class="hidden md:block bg-primary rounded-md py-2 px-4">
                <nav aria-label="Global">
                    <x-nav-link href="{{ route('home') }}">{{ __('Home') }}</x-nav-link>
                    <x-nav-link href="{{ route('products.index')}}">{{ __('Shop') }}</x-nav-link>
                    <!-- <x-nav-link>{{ __('Collections') }}</x-nav-link> -->
                    <!-- <x-nav-link>{{ __('Contact') }}</x-nav-link> -->
                </nav>
            </div>

            <div class="flex items-center">
                <div class="flex items-center justify-center gap-4">

                    <livewire:customer.cart.cart-button />

                    @if (Auth::guest())
                        <x-nav-link class="bg-primary" href="{{ route('login') }}">{{ __('Login') }}</x-nav-link>
                    @elseif (!Auth::user()->isAdmin())
                        <a href="{{ route('profile') }}"
                            class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-md bg-primary p-2">
                            <x-iconsax-bro-user-octagon class="w-6 h-6" />
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}"
                            class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-md bg-primary p-2">
                            <x-iconsax-bro-user-octagon class="w-6 h-6" />
                        </a>
                    @endif
                </div>

                <!-- Hamburger button for mobile -->
                <div class="block md:hidden ml-4" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-md bg-primary p-2">
                        <template x-if="open">
                            <x-iconsax-bro-close-square class="size-6" />
                        </template>
                        <template x-if="!open">
                            <x-iconsax-bro-menu-1 class="size-6" />
                        </template>
                    </button>

                    <!-- Mobile Navigation Menu -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="mt-2 rounded-lg bg-primary py-2 w-full absolute left-0 z-10 shadow-lg lg:hidden">
                        <nav class="flex flex-col gap-3 p-4">
                            <x-nav-link href="{{ route('home') }}">{{ __('Home') }}</x-nav-link>
                            <x-nav-link href="{{ route('products.index')}}">{{ __('Shop') }}</x-nav-link>
                            <!-- <x-nav-link>{{ __('Collections') }}</x-nav-link> -->
                            <!-- <x-nav-link>{{ __('Contact') }}</x-nav-link> -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
