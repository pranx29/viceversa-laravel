<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Scripts -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-background">
    @livewireScripts

    <div class="flex sm:flex-row flex-col">
        <div class="flex sm:h-screen flex-col justify-between border-foreground bg-primary min-w-72 sticky top-0">
            <div class="px-4 py-6">
                <x-application-logo class="w-20 h-20 mx-auto" />

                <ul class="mt-6 space-y-2">
                    <li>
                        <x-sidebar-link href="{{ route('admin.dashboard') }}"
                            :active="request()->routeIs('admin.dashboard')">
                            <x-heroicon-o-squares-2x2 class="w-5 h-5" />
                            <span> Dashboard </span>
                        </x-sidebar-link>
                    </li>

                    <li>
                        <x-sidebar-dropdown-link :active="request()->routeIs('admin.products.*')">
                            <x-slot name="title">
                                <x-heroicon-o-shopping-bag class="w-5 h-5" />
                                <span> Products </span>
                            </x-slot>
                            <ul>
                                <li>
                                    <x-sidebar-link href="{{ route('admin.products.index') }}"
                                        :active="request()->routeIs('admin.products.*')">
                                        <span> Product List </span>
                                    </x-sidebar-link>
                                </li>

                                <li>
                                    <x-sidebar-link href="{{ route('admin.dashboard') }}">
                                        <span> Categories </span>
                                    </x-sidebar-link>
                                </li>
                                <li>
                                    <x-sidebar-link href="{{ route('admin.dashboard') }}">
                                        <span> Variants </span>
                                    </x-sidebar-link>
                                </li>
                            </ul>
                        </x-sidebar-dropdown-link>
                    </li>

                    <li>
                        <x-sidebar-link href="{{ route('admin.dashboard') }}">
                            <x-heroicon-o-users class="w-5 h-5" />
                            <span> Customers </span>
                        </x-sidebar-link>
                    </li>

                    <li>
                        <x-sidebar-link href="{{ route('admin.dashboard') }}">
                            <x-heroicon-o-shopping-cart class="w-5 h-5" />
                            <span> Orders </span>
                        </x-sidebar-link>
                    </li>
                </ul>
            </div>

            <div class="sticky inset-x-0 bottom-0 border-foreground text-foreground">
                <div class="flex items-center gap-2 p-4">
                    <div>
                        <p class="text-xs">
                            <strong class="block font-bold">Eric Frusciante</strong>

                            <span> eric@frusciante.com </span>
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="text-xs ml-auto">
                        @csrf
                        <button type="submit" >
                            <x-heroicon-s-arrow-right-start-on-rectangle
                                class="w-5 h-5 text-button hover:text-button/80" />
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <main class="flex-1 bg-background">
            {{ $slot }}
        </main>
    </div>
</body>

</html>