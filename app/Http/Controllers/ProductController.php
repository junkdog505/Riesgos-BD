<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        return view('products.create');
    }

    // Guardar un nuevo producto en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image'
        ]);

        // Manejar la subida de la imagen si está presente
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $imageName = basename($imagePath);  // Extraer solo el nombre del archivo
        } else {
            $imageName = null;
        }

        // Crear el producto con los datos validados
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName  // Guardar el nombre de la imagen si fue subida
        ]);

        // Redirigir a la lista de productos
        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente');
    }
    public function select(Request $request)
    {
        // Validar que se haya seleccionado un producto
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
    
        // Redirigir a la página de edición del producto seleccionado
        return redirect()->route('products.edit', $request->product_id);
    }
    
    public function selectForm()
    {
        $products = Product::all(); // Obtener todos los productos
        return view('products.select', compact('products')); // Retornar la vista para seleccionar producto
    }

    // Mostrar el formulario para editar un producto existente
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Actualizar un producto existente
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $imageName = basename($imagePath);
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName
        ]);

        return redirect()->route('products.index');
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    // Agregar un producto al carrito
    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($product->stock < $request->quantity) {
            return back()->withErrors('No hay suficiente stock disponible.');
        }

        // Aquí deberías agregar la lógica para agregar el producto al carrito
        // Supongamos que tienes un modelo Cart o similar
        $cart = session()->get('cart', []);

        // Si el producto ya está en el carrito, aumentar la cantidad
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            // Si no está en el carrito, agregarlo
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('products.index')->with('success', 'Producto agregado al carrito');
    }
    public function favorites()
    {
        $favorites = auth()->user()->favorites; // Obtener los favoritos del usuario autenticado
        return view('products.favorites', compact('favorites'));
    }

    // Marcar o desmarcar un producto como favorito
    public function toggleFavorite(Product $product)
    {
        $user = auth()->user();

        // Si el producto ya está en favoritos, quitarlo
        if ($user->favorites->contains($product->id)) {
            $user->favorites()->detach($product->id);
        } else {
            // Si no está en favoritos, agregarlo
            $user->favorites()->attach($product->id);
        }

        return back();
    }
}
