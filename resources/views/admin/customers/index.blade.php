<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-primary-foreground sm:text-3xl">Customers</h1>
            </div>

            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max ">
                    <thead>
                        <tr class="border-b border-foreground bg-primary">
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Name</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Email</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Total Orders</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground hidden sm:table-cell">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="cursor-pointer hover:bg-primary">
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <p class="block font-semibold text-md">
                                        {{ $customer->first_name . ' ' . $customer->last_name }}</p>
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <p class="text-sm">{{ $customer->email }}</p>
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <p class="text-sm">{{ $customer->orders->count() }}</p>
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3 hidden sm:table-cell">
                                    <p class="text-sm">{{ $customer->created_at->format('Y-m-d') }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-primary-foreground">
                        Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of
                        {{ $customers->total() }}
                    </div>
                    <div>
                        {{ $customers->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
