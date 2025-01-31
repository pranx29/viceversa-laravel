<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;

class OrderDetails extends Component
{
    public $order;
    public $status;

    public function mount($order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'status' => 'required|in:Processing,Completed,Cancelled'
        ]);

        $this->order->update([
            'status' => $this->status
        ]);
    }

    public function render()
    {
        return view('livewire.admin.orders.order-details');
    }
}
