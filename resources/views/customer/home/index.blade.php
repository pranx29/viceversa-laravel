<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('customer.home.hero')
    @include('customer.home.best-seller')
    @include('customer.home.new-arrivals')
    @include('customer.home.about-us')
    @include('customer.home.footer')
    </main>
</x-app-layout>