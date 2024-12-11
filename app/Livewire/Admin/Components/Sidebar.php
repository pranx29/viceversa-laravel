<?php

namespace App\Livewire\Admin\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public $isSidebarOpen = false; 
    public $expandedMenus = [];   


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

    public function render()
    {
        return view('livewire.admin.components.sidebar');
    }
}
