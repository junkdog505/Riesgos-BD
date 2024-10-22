<!-- resources/views/cart/cart.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Tu carrito de compras</h1>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if($cartItems->isEmpty())
        <p>Tu carrito está vacío</p>
    @else
        <ul>
            @foreach($cartItems as $cartItem)
                <li>
                    <h3>{{ $cartItem->product->name }}</h3>
                    <p>Cantidad: {{ $cartItem->quantity }}</p>
                    <p>Precio total: ${{ $cartItem->product->price * $cartItem->quantity }}</p>
                </li>
            @endforeach
        </ul>
        <form action="{{ route('purchase.confirm') }}" method="POST">
            @csrf
            <button type="submit">Confirmar compra</button>
        </form>
    @endif
@endsection
