<div class="shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-bold text-primary-foreground mb-2">Frequent Customers</h2>
    <div
        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr class="border-b border-foreground bg-primary">
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Customer Name</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Email</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Total Orders</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($frequentCustomers as $customer)
                    <tr class="cursor-pointer hover:bg-primary">
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $customer['name'] }}</td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $customer['email'] }}
                        </td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                            {{ $customer['order_count'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</tr>
</thead>
