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
    <div class="mx-auto max-w-screen-xl p-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="md:flex md:items-center md:gap-12">
                <a class="block text-teal-600" href="#">
                    <span class="sr-only">Viceversa</span>
                    <x-application-logo class="w-20 h-20" />
                </a>
            </div>

            <div class="hidden md:block bg-primary rounded-full py-2 px-4">
                <nav aria-label="Global">
                    <x-nav-link href="{{ route('home') }}">{{ __('Home') }}</x-nav-link>
                    <x-nav-link>{{ __('Shop') }}</x-nav-link>
                    <x-nav-link>{{ __('Collections') }}</x-nav-link>
                    <x-nav-link>{{ __('Contact') }}</x-nav-link>
                </nav>
            </div>

            <div class="flex items-center">
                <div class="sm:flex hidden">
                    <a
                        class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-full bg-primary p-2">
                        <x-heroicon-o-shopping-cart class="w-6 h-6" />
                    </a>

                    <div class="sm:flex">
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
                    </div>

                    <div class="block md:hidden">
                        <button class="rounded bg-button p-2 text-primary transition hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
</header>