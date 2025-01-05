<?php

namespace App\Livewire\Customer\Account;

use Auth;
use Livewire\Component;

class Addresses extends Component
{
    public $addresses = [];
    public $address = [
        'street' => '',
        'city' => '',
        'postal_code' => '',
        'phone_number' => ''
    ];
    public $editingAddressId = null;

    public function mount()
    {
        $this->addresses = Auth::user()->addresses->toArray();
    }

    public function addAddress()
    {
        $this->validate([
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.postal_code' => 'required|string',
            'address.phone_number' => 'required|string',
        ]);

        $this->addresses[] = array_merge(['id' => count($this->addresses) + 1], $this->address);
        Auth::user()->addresses()->create($this->address);
        $this->reset('address');
        $this->dispatch('address-added');
        $this->addresses = Auth::user()->addresses->toArray();
        $this->dispatch('address-added');
    }

    public function editAddress($id)
    {
        $this->editingAddressId = $id;
        $this->address = collect($this->addresses)->firstWhere('id', $id);
    }

    public function updateAddress()
    {
        $this->validate([
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.postal_code' => 'required|string',
            'address.phone_number' => 'required|string',
        ]);

        foreach ($this->addresses as &$address) {
            if ($address['id'] == $this->editingAddressId) {
                $address = array_merge($address, $this->address);
                break;
            }
        }

        Auth::user()->addresses()->find($this->editingAddressId)->update($this->address);
        $this->dispatch('address-updated');
        $this->addresses = Auth::user()->addresses->toArray();
        $this->reset('address', 'editingAddressId');
        $this->dispatch('address-updated');
    }

    public function deleteAddress($id)
    {
        $this->addresses = collect($this->addresses)->reject(fn($address) => $address['id'] == $id)->toArray();
        Auth::user()->addresses()->find($id)->delete();
        if ($this->editingAddressId == $id) {
            $this->reset('address', 'editingAddressId');
        }
    }
    public function render()
    {
        return view('livewire.customer.account.addresses');
    }
}
