<!-- resources/views/products/create.blade.php -->
@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Crear Nuevo Producto</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nombre del Producto:</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Descripción:</label>
                <textarea name="description" id="description" class="w-full border-gray-300 p-2 rounded-lg" required></textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700">Precio:</label>
                <input type="number" name="price" id="price" class="w-full border-gray-300 p-2 rounded-lg" step="0.01" required>
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-gray-700">Stock:</label>
                <input type="number" name="stock" id="stock" class="w-full border-gray-300 p-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Imagen del Producto:</label>
                <input type="file" name="image" id="image" class="w-full border-gray-300 p-2 rounded-lg">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500">
                Crear Producto
            </button>
        </form>
    </div>
@endsection
