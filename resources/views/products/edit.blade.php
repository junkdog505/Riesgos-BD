@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Editar Producto</h1>

        <!-- Formulario para editar el producto seleccionado -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre del Producto:</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full border-gray-300 p-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Descripción:</label>
                <textarea name="description" id="description" class="w-full border-gray-300 p-2 rounded-lg">{{ $product->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">Precio:</label>
                <input type="number" name="price" id="price" value="{{ $product->price }}" class="w-full border-gray-300 p-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-gray-700">Stock:</label>
                <input type="number" name="stock" id="stock" value="{{ $product->stock }}" class="w-full border-gray-300 p-2 rounded-lg">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Imagen del Producto:</label>
                
                <!-- Mostrar la imagen actual si existe -->
                @if ($product->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="Imagen del producto" class="w-48 h-48 object-cover rounded-lg">
                    </div>
                @endif

                <input type="file" name="image" id="image" class="w-full border-gray-300 p-2 rounded-lg">
                <p class="text-gray-500 text-sm mt-1">Deja el campo en blanco si no deseas cambiar la imagen.</p>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                Actualizar Producto
            </button>
        </form>
    </div>
@endsection
