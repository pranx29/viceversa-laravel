<div class="bg-primary">
    <!-- Mobile menu button -->
    <button id="mobile-menu-button" class="lg:hidden fixed top-4 left-4 z-50 p-2 rounded-md" wire:click="toggleSidebar">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-40 w-72 bg-primary border-r border-foreground transition-transform duration-200 ease-in-out {{ $isSidebarOpen ? 'translate-x-0' : '-translate-x-full' }} lg:translate-x-0">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="p-6">
                <x-application-logo class="w-20 h-10 mx-auto" />
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 space-y-2">
                <x-sidebar-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')"
                    class="hover:bg-button text-foreground hover:text-black">
                    <div class="flex items-center px-4">
                        <x-iconsax-bol-category-2 class="w-5 h-5 mr-3" />
                        Dashboard
                    </div>
                </x-sidebar-link>

                <div class="space-y-2">
                    <button wire:click="toggleMenu('products')"
                        class="flex items-center justify-between w-full px-4 py-2 hover:bg-button rounded-lg hover:text-black {{ in_array('products', $expandedMenus) ? 'bg-button text-black' : 'text-foreground' }}">
                        <div class="flex items-center">
                            <x-iconsax-bol-bag-2 class="w-5 h-5 mr-3" />
                            Products
                        </div>
                        <svg class="w-4 h-4 transition-transform {{ in_array('products', $expandedMenus) ? 'rotate-180' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="products-submenu"
                        class="pl-11 space-y-2 {{ in_array('products', $expandedMenus) ? '' : 'hidden' }}">
                        <a href="{{ route('admin.products.index') }}"
                            class="block py-2 text-sm text-foreground hover:text-primary-foreground {{ request()->routeIs('admin.products.index') ? 'text-foreground font-medium' : '' }}">
                            Product List
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                            class="block py-2 text-sm text-foreground hover:text-primary-foreground {{ request()->routeIs('admin.products.index') ? 'text-foreground font-medium' : '' }}">
                            Variants
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                            class="block py-2 text-sm text-foreground hover:text-primary-foreground {{ request()->routeIs('admin.products.index') ? 'text-foreground font-medium' : '' }}">
                            Categories
                        </a>
                    </div>
                </div>
                <x-sidebar-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <div class="flex items-center px-4 text-foreground">
                        <x-iconsax-bol-user class="w-5 h-5 mr-3" />
                        Customers
                    </div>
                </x-sidebar-link>

                <x-sidebar-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <div class="flex items-center px-4 text-foreground">
                        <x-iconsax-bul-group-1 class="w-5 h-5 mr-3" />
                        Orders
                    </div>
                </x-sidebar-link>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-foreground">
                <div class="flex items-center space-x-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate text-white">Eric Frusciante</p>
                        <p class="text-sm text-foreground truncate">eric@frusciante.com</p>
                    </div>
                    <button wire:click="logout" class="p-2 rounded-md text-foreground hover:text-white">
                        <x-iconsax-bol-logout class="w-5 h-5" />
                    </button>
                </div>
            </div>
        </div>
    </aside>
</div>
