@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
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

        <h1 class="text-4xl font-bold mb-8">Lista de Productos</h1>

        <div class="grid grid-cols-3 gap-6">
            @foreach ($products as $product)
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                @if ($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="Imagen de {{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                @else
                <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg">
                    <span class="text-4xl font-bold text-gray-500 dark:text-gray-300">
                        {{ strtoupper(substr($product->name, 0, 1)) }}
                    </span>
                </div>
                @endif

                <h2 class="text-xl font-semibold mt-4">{{ $product->name }}</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $product->description }}</p>
                <p class="mt-4 font-bold">S/.{{ $product->price }}</p>
                <p class="text-sm text-gray-500">Stock disponible: {{ $product->stock }}</p>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    @if($product->stock > 0)
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="mt-2 inline-block bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-500">
                        Añadir al carrito
                    </button>
                    @else
                    <button type="button" class="mt-2 inline-block bg-gray-400 text-white py-2 px-4 rounded cursor-not-allowed" disabled>
                        No disponible
                    </button>
                    @endif
                </form>
            </div>
            @endforeach
        </div>

        <!-- Mostrar nombre de la base de datos y puerto -->
        <div class="mt-8">
            <p class="text-sm text-gray-500">Base de datos en uso: <strong>{{ env('DB_DATABASE') }}</strong></p>
            <p class="text-sm text-gray-500">Puerto de la base de datos: <strong>{{ env('DB_PORT') }}</strong></p>
        </div>
    </div>

    <div class="fixed bottom-4 right-4">
        <a href="{{ route('cart.show') }}" class="bg-red-600 text-white p-4 rounded-full hover:bg-red-500 shadow-lg flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l1.4-7H6.4l-.9-5H3M7 13l-1 5h11l-1-5M5 6h14M9 18h.01M15 18h.01" />
            </svg>
        </a>
    </div>
@endsection
