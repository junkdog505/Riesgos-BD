@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Resumen de Compra</h1>

        <table class="w-full text-left table-auto">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $orderItem)
                    <tr>
                        <td>{{ $orderItem->product->name }}</td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>S/. {{ number_format($orderItem->price, 2) }}</td>
                        <td>S/. {{ number_format($orderItem->quantity * $orderItem->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-8 text-right">
            <p class="text-lg">Subtotal: S/. {{ number_format($order->total_price, 2) }}</p>
            <p class="text-lg">IGV (18%): S/. {{ number_format($order->total_price * 0.18, 2) }}</p>
            <p class="text-xl font-bold">Total a Pagar: S/. {{ number_format($order->total_price * 1.18, 2) }}</p>
        </div>
    </div>
@endsection
