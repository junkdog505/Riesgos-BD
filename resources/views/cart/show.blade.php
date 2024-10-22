<!-- resources/views/cart/show.blade.php -->
@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Carrito de Compras</h1>

        <!-- Mostrar mensajes de éxito o error -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            <p class="text-lg">Tu carrito está vacío.</p>
        @else
            <table class="w-full text-left table-auto">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->product->name }}</td>
                            <td>S/. {{ number_format($cartItem->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="w-16">
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Actualizar</button>
                                </form>
                            </td>
                            <td>S/. {{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cartItem->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-8 flex justify-between">
                <h2 class="text-2xl font-bold">Total: S/. {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</h2>
                <a href="{{ route('cart.checkout') }}" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-500">Proceder a la Compra</a>
            </div>
        @endif
    </div>
@endsection
