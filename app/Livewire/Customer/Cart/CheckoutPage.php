<?php

namespace App\Livewire\Customer\Cart;

use Auth;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Stripe\PaymentIntent;

class CheckoutPage extends Component
{
    public $email;
    public $firstName;
    public $lastName;
    public $address;
    public $city;
    public $phone;
    public $cardNumber;
    public $expiryDate;
    public $cvv;
    public $cartItems;
    public $shippingCost;
    public $totalAmount;
    public $selectedAddress;

    protected $rules = [
        'email' => 'required|email',
        'firstName' => 'required|string|max:255',
        'lastName' => 'nullable|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'phone' => 'required|numeric|digits_between:10,15',
        'cardNumber' => 'required|numeric|digits:16',
        'expiryDate' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
        'cvv' => 'required|numeric|digits:3',
    ];


    public function mount($cartItems, $shippingCost)
    {
        $this->selectedAddress = auth()->user()->addresses->first()->id;
        $this->cartItems = $cartItems;
        $this->shippingCost = $shippingCost;
        $this->getTotalAmountProperty();
    }

    // Get the total amount of the cart
    public function getTotalAmountProperty()
    {
        $this->totalAmount = collect($this->cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function registeredUserCheckout()
    {
        $this->validate(
            [
                'cardNumber' => 'required|numeric|digits:16',
                'expiryDate' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
                'cvv' => 'required|numeric|digits:3',
                'selectedAddress' => 'required|in:' . auth()->user()->addresses->pluck('id')->implode(','),
            ]
        );

        $paymentService = new \App\Services\PaymentService();
        $paymentIntent = $paymentService->createPaymentIntent($this->totalAmount * 100);

        if ($paymentIntent->status === 'succeeded') {
            \DB::beginTransaction();
            try {
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'address_id' => $this->selectedAddress,
                ]);

                foreach ($this->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'size_id' => $item['size']['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'] - $item['discount'],
                    ]);
                }

                \DB::commit();

                // Remove the cart items
                Cart::clearCart();

            } catch (\Exception $e) {
                \DB::rollBack();
                dd($e->getMessage());
            }
        }

        redirect()->route('profile', [
            'order' => $order->id,
        ]);
    }

    public function placeOrder()
    {
        // Registered user
        if (auth()->check()) {
            $this->registeredUserCheckout();
        } else {
            // Guest user
            $this->validate([
                'email' => 'required|email',
                'firstName' => 'required|string|max:255',
                'lastName' => 'nullable|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'phone' => 'required|numeric|digits_between:10,15',
            ]);

            $this->validate([
                'cardNumber' => 'required|numeric|digits:16',
                'expiryDate' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
                'cvv' => 'required|numeric|digits:3',
            ]);

            $this->storeOrder();
        }
        // redirect()->route('cart.checkout.success');







        // // Inject the PaymentService in your controller
        // $paymentService = new \App\Services\PaymentService();

        // $order = [
        //     'email' => $this->email,
        //     'first_name' => $this->firstName,
        //     'last_name' => $this->lastName,
        //     'address' => $this->address,
        //     'city' => $this->city,
        //     'phone' => $this->phone,
        //     'cart_items' => $this->cartItems,
        //     'shipping_cost' => $this->shippingCost,
        //     'total_amount' => $this->totalAmount,
        // ];

        // // Example: After processing payment
        // $paymentIntent = $paymentService->createPaymentIntent($this->totalAmount * 100);

        // // After client confirms the payment, verify its status
        // $result = $paymentService->attachPaymentToOrder($paymentIntent->id, $order);

        // if ($result['success']) {
        //     // redirect()->route('customer.order', $order);
        // }

    }

    public function render()
    {
        return view('livewire.customer.cart.checkout-page');
    }
}
