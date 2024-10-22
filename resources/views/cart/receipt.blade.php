@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Comprobante de Compra</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Número de Comprobante: {{ $order->order_number }}</h2>
            <p class="mb-4"><strong>Fecha:</strong> {{ $order->order_date->format('d/m/Y H:i:s') }}</p>
            <p class="mb-4"><strong>Nombre del Cliente:</strong> {{ $order->user->name }}</p>
            <p class="mb-4"><strong>DNI:</strong> {{ $order->user->dni }}</p>
            <p class="mb-4"><strong>Correo:</strong> {{ $order->user->email }}</p>

            <h3 class="text-xl font-bold mb-4">Detalles de la compra</h3>
            <table class="w-full mb-4 text-left table-auto">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>S/. {{ number_format($item->price, 2) }}</td>
                            <td>S/. {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="text-xl font-bold">Total a Pagar: S/. {{ number_format($order->total_price, 2) }}</h3>
        </div>
    </div>
@endsection
