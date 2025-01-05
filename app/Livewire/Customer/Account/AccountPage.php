<?php

namespace App\Livewire\Customer\Account;

use Livewire\Component;

class AccountPage extends Component
{
    public string $activeTab = 'profile';

    public function mount()
    {
        if (request()->has('order')) {
            $this->activeTab = 'orders';
        }
    }

    public function switchTab(string $tab)
    {
        $this->activeTab = $tab;
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.customer.account.account-page');
    }
}
