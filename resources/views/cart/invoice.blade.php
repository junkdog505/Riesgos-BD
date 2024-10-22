<!-- resources/views/cart/invoice.blade.php -->
@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Factura</h1>

        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <p><strong>Número de Orden:</strong> {{ $order->order_number }}</p>
            <p><strong>Fecha de la Orden:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i:s') }}</p>
            <p><strong>Total:</strong> S/. {{ number_format($order->total_price, 2) }}</p>

            <h2 class="text-2xl font-semibold mt-4 mb-2">Productos:</h2>
            <ul>
                @foreach($order->orderItems as $item)
                    <li>
                        {{ $item->product->name }} - {{ $item->quantity }} unidades - S/. {{ number_format($item->price * $item->quantity, 2) }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
