<?php

namespace App\Livewire\Customer\Cart;

use Auth;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
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
    public $postalCode;
    public $phoneNumber;
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
        'postalCode' => 'required|string|max:255',
        'phoneNumber' => 'required|numeric|digits_between:10,15',
        'cardNumber' => 'required|numeric|digits:16',
        'expiryDate' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
        'cvv' => 'required|numeric|digits:3',
    ];


    public function mount()
    {
        $this->shippingCost = Order::SHIPPING_COST;
        $this->getCartItemsProperty();
        $this->getTotalAmountProperty();
    }

    public function getCartItemsProperty()
    {
        $cartItems = Cart::getCartItems();
        $this->cartItems = [];
        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']);
            $this->cartItems[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'discount' => $product->discount,
                'quantity' => $item['quantity'],
                'size' => $product->sizes->find($item['size_id']),
                'image' => $product->primaryImage(),
            ];
        }
    }

    // Get the total amount of the cart
    public function getTotalAmountProperty()
    {
        $this->totalAmount = collect($this->cartItems)->sum(function ($item) {
            return ($item['price'] - $item['discount']) * $item['quantity'];
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
                    'shipping_cost' => $this->shippingCost,
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

                // Adjust the stock
                foreach ($this->cartItems as $item) {
                    $product = Product::find($item['product_id']);
                    $product->sizes()->updateExistingPivot($item['size']['id'], [
                        'quantity_in_stock' => $item['size']['quantity_in_stock'] - $item['quantity'],
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

    public function guestUserCheckout()
    {
        $this->validate([
            'email' => 'required|email',
            'firstName' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postalCode' => 'required|string|max:255',
            'phoneNumber' => 'required|numeric|digits_between:10,15',
            'cardNumber' => 'required|numeric|digits:16',
            'expiryDate' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'cvv' => 'required|numeric|digits:3',
        ]);

        $paymentService = new \App\Services\PaymentService();
        $paymentIntent = $paymentService->createPaymentIntent($this->totalAmount * 100);

        if ($paymentIntent->status === 'succeeded') {
            \DB::beginTransaction();
            try {

                $address = Address::create([
                    'user_id' => null,
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'street' => $this->address,
                    'city' => $this->city,
                    'postal_code' => $this->postalCode,
                    'phone_number' => $this->phoneNumber,
                ]);

                $order = Order::create([
                    'user_id' => null,
                    'address_id' => $address->id,
                    'guest_email' => $this->email,
                    'shipping_cost' => $this->shippingCost,
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

                // Adjust the stock
                foreach ($this->cartItems as $item) {
                    $product = Product::find($item['product_id']);
                    $product->sizes()->updateExistingPivot($item['size']['id'], [
                        'quantity_in_stock' => $item['size']['quantity_in_stock'] - $item['quantity'],
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

        dd('Order placed successfully');
    }

    public function placeOrder()
    {
        // Registered user
        if (auth()->check()) {
            $this->registeredUserCheckout();
        } else {
            // Guest user
            $this->guestUserCheckout();

        }
    }

    public function render()
    {
        return view('livewire.customer.cart.checkout-page');
    }
}
