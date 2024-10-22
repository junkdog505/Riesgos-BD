@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Mis Productos Favoritos</h1>

        @if($favorites->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No tienes productos en tus favoritos.</p>
        @else
            <div class="grid grid-cols-3 gap-6">
                @foreach ($favorites as $product)
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <!-- Mostrar imagen del producto o un avatar con las iniciales -->
                        @if ($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="Imagen de {{ $product->name }}" class="w-full h-50 object-cover rounded-lg">
                        @else
                            <!-- Si no hay imagen, mostrar avatar con las iniciales -->
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg">
                                <span class="text-4xl font-bold text-gray-500 dark:text-gray-300">
                                    {{ strtoupper(substr($product->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif

                        <!-- Información del producto -->
                        <h2 class="text-xl font-semibold mt-4">{{ $product->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $product->description }}</p>
                        <p class="mt-4 font-bold">S/.{{ $product->price }}</p>
                        <!-- Botón para eliminar de favoritos -->
                        <form action="{{ route('products.toggleFavorite', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-2 inline-block bg-red-600 text-white py-2 px-4 rounded hover:bg-red-500">Quitar de Favoritos</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
