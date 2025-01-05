<div>
    <div class="bg-primary shadow rounded-lg">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-bold text-primary-foreground">Order History</h2>
            <p class="text-sm text-foreground">View your past orders and invoices</p>
        </div>

        @if ($orders && $orders->count() > 0)
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left table-auto min-w-max rounded-md">
                    <thead>
                        <tr class="border-b border-foreground">
                            <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Order ID</th>
                            <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Date</th>
                            <th class="p-4 text-sm font-normal leading-none text-primary-foreground hidden md:table-cell">
                                Status</th>
                            <th class="p-4 text-sm font-normal leading-none text-primary-foreground hidden md:table-cell">
                                Total</th>
                            <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                                    <tr class="hover:bg-primary transition-all duration-300">
                                        <td class="p-4 border-b border-foreground text-foreground py-3">{{ $order['id'] }}</td>
                                        <td class="p-4 border-b border-foreground text-foreground py-3">{{ $order['created_at'] }}
                                        </td>
                                        <td class="p-4 border-b border-foreground text-foreground py-3 hidden md:table-cell">
                                            {{ $order['status'] }}
                                        </td>
                                        <td class="p-4 border-b border-foreground text-foreground py-3 hidden md:table-cell">
                                            LKR
                                            {{ number_format($order->items->sum(function ($item) {
                            return $item->quantity * $item->price; }) + $shippingCost, 2) }}
                                        </td>
                                        <td class="p-4 border-b border-foreground py-3">
                                            <button wire:click="viewInvoice({{ $order['id'] }})">
                                                <span
                                                    class="inline-flex items-center justify-center rounded-md bg-button px-5 py-2 font-medium transition-colors duration-300 hover:bg-opacity-80">
                                                    <span class="mr-2">View Invoice</span>
                                                    <x-iconsax-bro-eye class="h-5 w-5 transition-transform group-hover:translate-y-1" />
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="p-6 text-center">
                <p class="text-foreground">No orders found.</p>
            </div>
        @endif

    </div>

    <!-- Invoice Modal -->
    @if($selectedOrder)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-primary rounded-lg shadow-xl max-w-3xl w-full">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-primary-foreground">Invoice for Order #{{ $selectedOrder['id'] }}
                    </h3>
                    <p class="text-sm text-foreground">Order details and summary</p>
                </div>
                <div class="p-6">
                    <div class="flex justify-between mb-4">
                        <div>
                            <h4 class="font-semibold text-primary-foreground">Order Date</h4>
                            <p class="text-foreground">{{ $selectedOrder['created_at'] }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-primary-foreground">Order Status</h4>
                            <p class="text-foreground">{{ $selectedOrder['status'] }}</p>
                        </div>
                    </div>
                    <table class="w-full text-left table-auto min-w-max rounded-md">
                        <thead>
                            <tr class="border-b border-foreground">
                                <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Product</th>
                                <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Size</th>
                                <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Quantity</th>
                                <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Price</th>
                                <th class="p-4 text-sm font-normal leading-none text-primary-foreground">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($selectedOrder->items as $item)
                                <tr class="hover:bg-primary transition-all duration-300">
                                    <td class="p-4 border-b border-foreground text-foreground py-3">{{ $item->product->name }}
                                    </td>
                                    <td class="p-4 border-b border-foreground text-foreground py-3">{{ $item->size->name }}</td>
                                    <td class="p-4 border-b border-foreground text-foreground py-3">{{ $item->quantity }}</td>
                                    <td class="p-4 border-b border-foreground text-foreground py-3">
                                        LKR {{ number_format($item->price, 2) }}</td>
                                    <td class="p-4 border-b border-foreground text-foreground py-3">
                                        LKR {{ number_format($item['quantity'] * $item['price'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 text-right">
                        <p class="font-semibold text-primary-foreground">Subtotal:
                            LKR
                            {{ number_format($selectedOrder->items->sum(function ($item) {
            return $item->quantity * $item->price; }), 2) }}
                        </p>
                        <p class="font-semibold text-primary-foreground">Shipping Cost:
                            LKR {{ number_format($shippingCost, 2) }}</p>
                        <p class="font-semibold text-primary-foreground">Total:
                            LKR
                            {{ number_format($selectedOrder->items->sum(function ($item) {
            return $item->quantity * $item->price; }) + $shippingCost, 2) }}
                        </p>
                    </div>
                </div>
                <div class="px-6 py-4 border-t text-right">
                    <x-primary-button wire:click="closeInvoice">
                        Close
                    </x-primary-button>
                </div>
            </div>
        </div>
    @endif
</div>