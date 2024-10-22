<!-- resources/views/cart/receipt.blade.php -->
@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Comprobante de Compra</h1>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Número de Orden: {{ $order->order_number }}</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Fecha de compra: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Nombre del Cliente: {{ auth()->user()->name }}</p>
            <p class="text-gray-600 dark:text-gray-400 mt-2">DNI: {{ auth()->user()->dni }}</p>

            <table class="w-full mt-6 text-left table-auto">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>S/. {{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>S/. {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <h2 class="text-2xl font-bold">Total: S/. {{ number_format($order->total_price, 2) }}</h2>
                <p class="text-gray-600 dark:text-gray-400">IGV: S/. {{ number_format($order->total_price * 0.18, 2) }}</p>
                <p class="text-gray-600 dark:text-gray-400">Total a Pagar: S/. {{ number_format($order->total_price * 1.18, 2) }}</p>
            </div>
        </div>
    </div>
@endsection
