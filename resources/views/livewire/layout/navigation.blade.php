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
                <div class="flex items-center justify-center">
                    <a href="{{ route('cart.show') }}"
                        class="hover:bg-white text-foreground hover:text-black transition-colors duration-300 rounded-full bg-primary p-2">
                        <x-heroicon-o-shopping-cart class="w-6 h-6" />
                    </a>

                    <div class="sm:flex">
                        @if (Auth::guest())
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
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Hamburger button for mobile -->
                <div class="block md:hidden ml-2" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="rounded p-2 text-foreground transition hover:text-foreground/80">
                        <template x-if="open">
                            <x-heroicon-o-x-mark class="size-6" />
                        </template>
                        <template x-if="!open">
                            <x-heroicon-o-bars-3 class="size-6" />
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
                            <x-nav-link>{{ __('Shop') }}</x-nav-link>
                            <x-nav-link>{{ __('Collections') }}</x-nav-link>
                            <x-nav-link>{{ __('Contact') }}</x-nav-link>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>