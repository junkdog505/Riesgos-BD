@extends('layouts.home')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">Seleccionar Producto para Editar</h1>

        <!-- Formulario para seleccionar el producto -->
        <form action="{{ route('products.select') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="product_id" class="block text-gray-700">Seleccionar Producto:</label>
                <select name="product_id" id="product_id" class="w-full border-gray-300 p-2 rounded-lg" onchange="updateProductDetails()">
                    <option value="">Seleccione un producto</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-image="{{ $product->image }}" data-stock="{{ $product->stock }}">
                            {{ $product->id }} - {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Información adicional del producto seleccionado -->
            <div id="product-details" class="mt-4 hidden">
                <!-- Imagen del producto -->
                <div id="product-image-container" class="mb-4">
                    <img id="product-image" src="" alt="Imagen del producto" class="w-48 h-48 object-cover rounded-lg">
                </div>

                <!-- Stock del producto -->
                <p id="product-stock" class="text-gray-700"></p>
            </div>

            <!-- Botón para proceder a la edición -->
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 mt-4">
                Editar Producto
            </button>
        </form>
    </div>

    <script>
        function updateProductDetails() {
            const selectElement = document.getElementById('product_id');
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const productDetails = document.getElementById('product-details');
            const productImage = document.getElementById('product-image');
            const productStock = document.getElementById('product-stock');
            const imageContainer = document.getElementById('product-image-container');

            const image = selectedOption.getAttribute('data-image');
            const stock = selectedOption.getAttribute('data-stock');

            if (image || stock) {
                productDetails.classList.remove('hidden'); // Mostrar los detalles
            } else {
                productDetails.classList.add('hidden'); // Ocultar si no hay detalles
            }

            if (image) {
                productImage.src = `/storage/products/${image}`;
                imageContainer.classList.remove('hidden');
            } else {
                imageContainer.classList.add('hidden');
            }

            productStock.textContent = `Stock disponible: ${stock}`;
        }
    </script>
@endsection
