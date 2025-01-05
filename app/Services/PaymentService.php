<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    // Create a PaymentIntent
    public function createPaymentIntent($amount, $currency = 'lkr', $description = 'Order payment')
    {
        return PaymentIntent::create([
            'amount' => $amount,
            'currency' => $currency,
            'payment_method' => 'pm_card_visa',
            'confirmation_method' => 'automatic',
            'confirm' => true,
            'return_url' => route('cart.checkout'),
            'description' => $description,
        ]);
    }

    // Retrieve a PaymentIntent to check its status
    public function getPaymentIntent($paymentIntentId)
    {
        return PaymentIntent::retrieve($paymentIntentId);
    }

}
