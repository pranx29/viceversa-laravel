<?php

namespace App\Livewire\Customer\Account;

use Auth;
use Livewire\Component;

class Orders extends Component
{
    public $orders = [];
    public $selectedOrder = null;
    public $shippingCost = 250;

    public function mount()
    {
        $this->orders = Auth::user()->orders;
        if (request()->has('order')) {
            $this->viewInvoice(request('order'));
        }

    }

    public function viewInvoice($orderId)
    {
        // Find the selected order from the orders list
        $this->selectedOrder = collect($this->orders)->firstWhere('id', $orderId);
    }

    public function closeInvoice()
    {
        $this->selectedOrder = null;
    }
    public function render()
    {
        return view('livewire.customer.account.orders');
    }
}
