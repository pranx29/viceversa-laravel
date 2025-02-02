@extends('layouts.customer')

@section('content')

<div class="container mx-auto p-6">
    <h1 class="font-bold text-primary-foreground text-4xl mb-8">Order Confirmation</h1>

    <div class="bg-green-100 p-4 rounded-md mb-4">
        <h2 class="font-semibold text-lg text-green-700">Your order has been successfully placed!</h2>
        <p class="text-sm text-green-700">Thank you for your purchase. Your order will be processed shortly.
            <span>
                @if (Auth::check())
                    <a href="{{ route('profile', ['order' => $order->id]) }}" class="hover:underline">Click to check order status.</a>
                @endif
            </span>
        </p>

    </div>

    <div>
        <div class="border-b pb-4 mb-4">
            <h3 class="text-lg font-semibold text-primary-foreground">Order Details</h3>
            <p class="text-sm text-foreground">Order ID: #{{ $order->id }}</p>
            <p class="text-sm text-foreground">Order Date: {{ $order->created_at->format('d M Y') }}</p>
        </div>
        <table class="w-full text-left table-auto min-w-max rounded-md">
            <thead>
                <tr class="border-b border-foreground">
                    <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Product</th>
                    <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Size</th>
                    <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Quantity</th>
                    <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Price</th>
                    <th class="p-4 text-sm font-normal leading-none text-primary-foreground hidden sm:table-cell">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr class="hover:bg-primary transition-all duration-300">
                        <td class="p-4 border-b border-foreground text-foreground py-3">{{ $item->product->name }}</td>
                        <td class="p-4 border-b border-foreground text-foreground py-3">{{ $item->size->name }}</td>
                        <td class="p-4 border-b border-foreground text-foreground py-3">{{ $item->quantity }}</td>
                        <td class="p-4 border-b border-foreground text-foreground py-3">LKR
                            {{ number_format($item->price, 2) }}
                        </td>
                        <td class="p-4 border-b border-foreground text-foreground py-3 hidden sm:table-cell">LKR
                            {{ number_format($item->quantity * $item->price, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 text-right">
            <p class="font-semibold text-primary-foreground">
                Subtotal: LKR {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity), 2) }}
            </p>
            <p class="font-semibold text-primary-foreground">Shipping: LKR {{ number_format($order->shipping_cost, 2) }}
            </p>
            <p class="font-semibold text-primary-foreground">
                Total: LKR
                {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity) + $order->shipping_cost, 2) }}
            </p>
        </div>
    </div>

    @if(Auth::check())
        <a href="{{ route('profile', ['order' => $order->id]) }}"
            class="bg-button text-black px-6 py-2 rounded-md transition-colors duration-300 hover:bg-opacity-80">View
            Order</a>
    @endif
</div>

@endsection
