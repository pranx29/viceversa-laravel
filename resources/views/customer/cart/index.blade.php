@extends('layouts.customer')

@section('content')
@livewire('customer.cart.cart-page', ['products' => $cartItems])
@endsection