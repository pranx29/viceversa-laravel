@extends('layouts.customer')
@section('content')

<livewire:customer.products.product-show :product="$product" />

@endsection