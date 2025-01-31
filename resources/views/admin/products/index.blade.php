<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-primary-foreground sm:text-3xl">Products</h1>
                <a href="{{ route('admin.products.create') }}"
                    class="flex items-center gap-2 rounded-lg bg-button px-4 py-2 text-sm font-medium hover:bg-opacity-80 transition-colors">
                    <x-iconsax-bro-add class="w- h-5" />
                    <span>Add Product</span>
                </a>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    <nav class="flex gap-4" aria-label="Tabs">
                        <a href="{{route('admin.products.index')}}"
                            class="{{ !request()->has('active') ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            All
                        </a>

                        <a href="{{route('admin.products.index', ['active' => true])}}"
                            class="{{ request()->get('active') === '1' ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            Active
                        </a>

                        <a href="{{route('admin.products.index', ['active' => false])}}"
                            class="{{ request()->get('active') === '0' ? 'shrink-0 rounded-lg bg-button p-2 text-sm font-medium hover:bg-button hover:text-black' : 'shrink-0 rounded-lg p-2 text-sm font-medium text-foreground bg-primary hover:bg-button hover:text-black' }}">
                            Inactive
                        </a>
                    </nav>
                </div>
            </div>

            <div
                class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-primary/50 shadow-md rounded-lg bg-clip-border">
                <table class="w-full text-left table-auto min-w-max ">
                    <thead>
                        <tr class="border-b border-foreground bg-primary">
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Product</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Status</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground hidden sm:table-cell">Stock
                            </th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground hidden sm:table-cell">
                                Category</th>
                            <th class="p-4 text-sm font-normal leading-none text-foreground">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr onclick="window.location='{{ route('admin.products.show', $product->slug) }}'"
                                class="cursor-pointer hover:bg-primary">
                                <td
                                    class="p-4 border-b border-foreground text-primary-foreground py-3 flex items-center gap-6">
                                    <img src="{{ $product->primaryImage() }}" alt="{{ $product->name }}"
                                        class="w-10 h-10 object-cover rounded" />
                                    <p class="block font-semibold text-md">{{ $product->name }}</p>
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <x-badge
                                        :active="$product->is_active">{{ $product->is_active ? 'Active' : 'Inactive' }}</x-badge>
                                </td>
                                <td
                                    class="p-4 border-b border-foreground text-primary-foreground py-3 hidden sm:table-cell">
                                    <p class="text-sm ">{{ $product->totalStock()}} for
                                        {{ $product->sizes->count() }} variant(s)
                                    </p>
                                </td>
                                <td
                                    class="p-4 border-b border-foreground text-primary-foreground py-3 hidden sm:table-cell">
                                    <p class="text-sm ">{{ $product->category->name }}</p>
                                </td>
                                <td class="p-4 border-b border-foreground text-primary-foreground py-3">
                                    <p class="text-sm">{{ number_format($product->price, 2) }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-between items-center px-4 py-3">
                    <div class="text-sm text-primary-foreground">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                    </div>
                    <div>
                        {{ $products->links('pagination::custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
