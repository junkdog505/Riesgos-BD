<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function confirmPurchase()
    {
        $cartItems = auth()->user()->cartItems;
        $total = 0;

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;

            if ($product->stock < $cartItem->quantity) {
                return back()->withErrors("No hay suficiente stock del producto: {$product->name}");
            }

            // Reducir el stock del producto
            $product->stock -= $cartItem->quantity;
            $product->save();

            $total += $product->price * $cartItem->quantity;
        }

        // Crear la factura
        Invoice::create([
            'user_id' => auth()->id(),
            'total' => $total
        ]);

        // Vaciar el carrito (opcional)
        auth()->user()->cartItems()->delete();

        return redirect()->route('products.index')->with('success', 'Compra confirmada y factura generada.');
    }
}
