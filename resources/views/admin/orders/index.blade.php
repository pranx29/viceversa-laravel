<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-primary-foreground sm:text-3xl">Orders</h1>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    <nav class="flex gap-4" aria-label="Tabs">
                        <a href="{{route('admin.orders.index')}}"
                            class="{{ !request()->has('status') ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            All
                        </a>

                        <a href="{{route('admin.orders.index', ['status' => 'Completed'])}}"
                            class="{{ request()->get('status') === 'Completed' ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            Completed
                        </a>

                        <a href="{{route('admin.orders.index', ['status' => 'Processing'])}}"
                            class="{{ request()->get('status') === 'Processing' ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            Processing
                        </a>

                        <a href="{{route('admin.orders.index', ['status' => 'Cancelled'])}}"
                            class="{{ request()->get('status') === 'Cancelled' ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            Cancelled
                        </a>
                    </nav>
                </div>
            </div>

            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max ">
                    <thead>
                        <tr class="border-b border-foreground bg-primary">
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Order ID</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Customer Name</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Order Date</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Total</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr onclick="window.location='{{ route('admin.orders.show', $order->id) }}'"
                                class="cursor-pointer hover:bg-primary">
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    {{ $order->id }}
                                </td>
                                @if ($order->user_id)
                                    <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                        {{ $order->user->first_name }} {{ $order->user->last_name }}
                                    </td>
                                @else
                                    <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                        -
                                    </td>
                                @endif

                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    {{ $order->created_at->format('Y-m-d') }}
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    {{ number_format($order->total(), 2) }}
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <x-badge :active="$order->status === 'Completed'">{{ ucfirst($order->status) }}</x-badge>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-primary-foreground">
                        Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }}
                    </div>
                    <div>
                        {{ $orders->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
