<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public $isSidebarOpen = false;
    public $expandedMenus = [];

    public function mount()
    {
        // Expand the menu for the current URL
        $this->expandedMenus = $this->getExpandedMenus();
    }

    // Get the expanded menus based on the current URL
    public function getExpandedMenus()
    {
        $currentUrl = request()->path();
        $expandedMenus = [];

        if (strpos($currentUrl, 'sizes') !== false) {
            $expandedMenus[] = 'products';
        } elseif (strpos($currentUrl, 'categories') !== false) {
            $expandedMenus[] = 'products';
        } elseif (strpos($currentUrl, 'products') !== false) {
            $expandedMenus[] = 'products';
        }
        return $expandedMenus;
    }

    // Toggle sidebar for mobile view
    public function toggleSidebar()
    {
        $this->isSidebarOpen = !$this->isSidebarOpen;
    }

    // Toggle submenu
    public function toggleMenu($menuId)
    {
        if (in_array($menuId, $this->expandedMenus)) {
            $this->expandedMenus = array_diff($this->expandedMenus, [$menuId]);
        } else {
            $this->expandedMenus[] = $menuId;
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.components.sidebar');
    }
}
