<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4 text-primary-foreground">
    <div class="bg-primary shadow rounded-lg p-4">
        <div class="flex flex-row items-center justify-between pb-2">
            <h3 class="text-sm font-medium">Total Revenue</h3>
            <x-iconsax-lin-dollar-circle class="h-4 w-4 text-foreground" />
        </div>
        <div>
            <div class="text-2xl font-bold">LKR {{ number_format($totalRevenue, 2) }}</div>
            <p class="text-xs text-foreground">After discounts</p>
        </div>
    </div>
    <div class="bg-primary shadow rounded-lg p-4">
        <div class="flex flex-row items-center justify-between pb-2">
            <h3 class="text-sm font-medium">Total Orders</h3>
            <x-iconsax-bro-icon class="h-4 w-4 text-foreground" />
        </div>
        <div>
            <div class="text-2xl font-bold">+{{$orderCounts['total']}}</div>
            <p class="text-xs text-foreground">Processing: {{$orderCounts['processing']}} | Completed: {{$orderCounts['completed']}} | Cancelled: {{$orderCounts['cancelled']}} </p>
        </div>
    </div>
    <div class="bg-primary shadow rounded-lg p-4">
        <div class="flex flex-row items-center justify-between pb-2">
            <h3 class="text-sm font-medium">Total Customers</h3>
            <x-iconsax-lin-user class="h-4 w-4 text-foreground" />
        </div>
        <div>
            <div class="text-2xl font-bold">{{$totalCustomers}}</div>
            <p class="text-xs text-foreground">Active customers this month</p>
        </div>
    </div>
    <div class="bg-primary shadow rounded-lg p-4">
        <div class="flex flex-row items-center justify-between pb-2">
            <h3 class="text-sm font-medium">Low Stock Products</h3>
            <x-iconsax-lin-bag-2 class="h-4 w-4 text-foreground" />
        </div>
        <div>
            <div class="text-2xl font-bold">
                {{$lowStockProductsCount}}
            </div>
            <p class="text-xs text-foreground">Products with stock < 5</p>
        </div>
    </div>
</div>
