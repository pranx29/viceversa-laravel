<div class="max-w-7xl mx-auto sm:px-12 lg:px-16 min-h-screen">
    <div class="card">
        <div class="card-header">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-bold text-primary-foreground sm:text-3xl">Order Details - #{{$order->id}}</h3>
                <a href="{{ route('admin.orders.index') }}"
                    class="text-primary-foreground hover:text-foreground transition-all duration-300 inline-flex items-center gap-2">
                    <x-iconsax-out-arrow-left class="size-5" />
                    Back to List
                </a>
            </div>
        </div>
        <div class="max-w-7xl mx-auto py-8 space-y-8">
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-primary-foreground">Customer Information</h3>
                        @if($order->user)
                            <p class="text-foreground">
                                <strong class="text-primary-foreground">Name:</strong> {{ $order->user->first_name }}
                                {{ $order->user->last_name }}
                            </p>
                            <p class="text-foreground">
                                <strong class="text-primary-foreground">Email:</strong> {{ $order->user->email }}
                            </p>
                        @else
                            <p class="text-foreground">
                                <strong class="text-primary-foreground">Name:</strong> -
                            </p>
                            <p class="text-foreground">
                                <strong class="text-primary-foreground">Email:</strong> {{ $order->guest_email }}
                            </p>
                        @endif


                        <p class="text-foreground">
                            <strong class="text-primary-foreground">Phone:</strong> {{ $order->address->phone_number }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-primary-foreground">Shipping Address</h3>
                        <p class="text-foreground">
                            {{ $order->address->street }}, {{ $order->address->city }},
                            {{ $order->address->postal_code }}
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-bold mb-2 text-primary-foreground">Order Items</h3>
                </div>
                <div>
                    <div
                        class="relative flex flex-col w-full h-full overflow-scroll bg-primary/50 shadow-md rounded-lg bg-clip-border">
                        <table class="w-full text-left table-auto min-w-max">
                            <thead>
                                <tr class="border-b border-foreground bg-primary">
                                    <th class="p-4 text-sm font-normal leading-none text-foreground">Item</th>
                                    <th class="p-4 text-sm font-normal leading-none text-foreground">Quantity</th>
                                    <th class="p-4 text-sm font-normal leading-none text-foreground">Price</th>
                                    <th class="p-4 text-sm font-normal leading-none text-foreground">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr class="cursor-pointer">
                                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                            LKR {{ number_format($item->price, 2) }}</td>
                                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                            LKR {{ number_format($item->quantity * $item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center text-foreground">
                <div>
                    <strong class="text-primary-foreground">Total:</strong> LKR {{ number_format($order->total(), 2) }}
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-primary-foreground">Status </span>
                    <x-select-input wire:model.live="status">
                        <option value="Processing">Processing</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </x-select-input>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
