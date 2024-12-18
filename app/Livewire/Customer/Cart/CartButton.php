<?php

namespace App\Livewire\Customer\Cart;

use App\Models\Cart;
use App\Models\Guest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartButton extends Component
{
    public $cartCount = 0;

    protected $listeners = [
        'productAddedToCart' => 'incrementCartCount',
        'productRemoveFromCart' => 'decrementCartCount'
    ];

    public function mount()
    {
        $this->cartCount = Cart::getCartCount();
    }

    public function incrementCartCount()
    {
        $this->cartCount++;
    }

    public function decrementCartCount($count = null)
    {
        if ($count) {
            $this->cartCount -= $count;
            return;
        }
        $this->cartCount--;
    }

    public function showCart()
    {
        return redirect()->route('cart.show');
    }

    public function render()
    {
        return view('livewire.customer.cart.cart-button');
    }
}
