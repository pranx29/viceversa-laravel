@extends('layouts.customer')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-4xl font-bold text-primary-foreground mb-8">
        Men's Clothing
    </h2>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Filters -->
        <div class="w-full md:w-1/4">
            <livewire:customer.components.product-filter />
        </div>

        <!-- Product Grid -->
        <div class="w-full md:w-3/4">
            <livewire:customer.products.product-listing :products="$products" />
        </div>
    </div>
</div>
@endsection
