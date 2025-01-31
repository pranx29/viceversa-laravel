<div class="shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-primary-foreground mb-2">Top-Selling Products</h2>
    <div
        class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
        <table class="w-full text-left table-auto min-w-max">
            <thead>
                <tr class="border-b border-foreground bg-primary">
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Product Name</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Sold Quantity</th>
                    <th class="p-4 text-sm font-normal leading-none text-foreground">Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($topSellingProducts as $product)
                    <tr class="cursor-pointer hover:bg-primary">
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $product['name'] }}</td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $product['quantity'] }}
                        </td>
                        <td class="p-4 border-b border-foreground text-primary-foreground py-3">{{ $product['revenue']}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
