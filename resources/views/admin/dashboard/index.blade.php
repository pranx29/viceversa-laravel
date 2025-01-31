<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h1 class="text-2xl font-bold text-primary-foreground sm:text-3xl">Dashboard</h1>
            @include('admin.dashboard.key-metrics')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @include('admin.dashboard.best-selling-products')
                @include('admin.dashboard.low-stock-alerts')
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @include('admin.dashboard.frequent-customers')
                @include('admin.dashboard.slow-api-endpoints')
            </div>
        </div>
    </div>
    </div>
</x-admin-layout>
