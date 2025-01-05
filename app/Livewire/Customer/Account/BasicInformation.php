<?php

namespace App\Livewire\Customer\Account;

use Livewire\Component;

class BasicInformation extends Component
{

    public $firstName;
    public $lastName;
    public $email;


    public function mount()
    {
        $user = auth()->user();
        $this->firstName = $user->first_name;
        $this->lastName = $user->last_name;
        $this->email = $user->email;
    }

    public function save()
    {
        $this->validate([
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
        ]);

        $this->dispatch('basic-information-updated');
    }
    public function render()
    {
        return view('livewire.customer.account.basic-information');
    }
}
