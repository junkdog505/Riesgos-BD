<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Mostrar carrito
    public function show()
    {
        $cartItems = auth()->user()->cartItems;
        return view('cart.show', compact('cartItems'));
    }

    // Agregar producto al carrito
    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $cartItem = $user->cartItems()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $user->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.show');
    }

    // Actualizar la cantidad de un producto en el carrito
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Actualizar la cantidad del producto en el carrito
        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.show')->with('success', 'Cantidad actualizada exitosamente.');
    }

    // Eliminar producto del carrito
    public function remove(Product $product)
    {
        auth()->user()->cartItems()->where('product_id', $product->id)->delete();
        return redirect()->route('cart.show');
    }

    public function checkout()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems;

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'El carrito está vacío.');
        }

        DB::transaction(function () use ($cartItems, $user) {
            // Crear una nueva orden
            $order = $user->orders()->create([
                'total_price' => $cartItems->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                }),
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Generar un número único de orden
                'order_date' => Carbon::now(),
            ]);

            // Guardar los productos en la tabla order_items
            foreach ($cartItems as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product->id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                // Reducir el stock del producto
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            // Limpiar el carrito
            $user->cartItems()->delete();
        });

        // Redirigir a la vista del comprobante
        return redirect()->route('order.receipt', ['order' => $order->id]);
    }
    public function showReceipt(Order $order)
    {
        return view('cart.receipt', compact('order'));
    }
}
