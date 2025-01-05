<?php

namespace App\Http\Controllers\Customer;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Climate\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'stripeToken' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a payment charge on Stripe
            $charge = Charge::create([
                'amount' => $request->amount * 100, // Convert to cents
                'currency' => 'usd', // Set your currency
                'source' => $request->stripeToken,
                'description' => 'Order Payment',
            ]);

            // Optionally, store the order in your database
            $order = Order::create([
                'user_id' => auth()->id(), // Assuming the user is authenticated
                'amount' => $request->amount,
                'status' => 'paid', // Order status
                'payment_gateway' => 'stripe',
                'transaction_id' => $charge->id, // Store Stripe transaction ID
            ]);

            // Redirect to a success page
            return redirect()->route('payment.success', ['order' => $order]);

        } catch (\Exception $e) {
            // Handle any exceptions, such as payment failures
            return back()->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    }
}
