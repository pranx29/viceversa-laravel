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



<header class="top-0 left-0 right-0 z-50 p-4">
    <nav class="flex items-center justify-between">

        <!-- Logo Section -->
        <a href="#">
            <x-application-logo class="w-20 h-20" />
        </a>

        <!-- Navigation Links for Large Screens -->
        <div class="hidden md:flex md:items-center md:space-x-5 py-1 px-3 bg-primary rounded-full">
            <x-nav-link href="{{ route('home') }}">{{ __('Home') }}</x-nav-link>
            <x-nav-link>{{ __('Mens') }}</x-nav-link>
            <x-nav-link>{{ __('Womens') }}</x-nav-link>
            <x-nav-link>{{ __('Contact') }}</x-nav-link>
        </div>

        <!-- Shopping Cart and Login Section -->
        <div class="flex items-center">
            <a
                class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-full bg-primary p-2">
                <x-heroicon-o-shopping-cart class="w-6 h-6" />
            </a>
            @guest
                <x-nav-link class="bg-primary ml-4" href="{{ route('login') }}">{{ __('Login') }}</x-nav-link>
            @else
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-full bg-primary p-2">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                    x-on:profile-updated.window="name = $event.detail.name"></div>

                                <div>
                                    <x-heroicon-o-user-circle class="w-6 h-6" />
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
            @endguest
            </div>


    </nav>
</header>