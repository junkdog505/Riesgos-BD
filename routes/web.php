<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//use App\Http\Controllers\FavoriteController;
//use App\Http\Controllers\PurchaseController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');  // Mostrar todos los productos
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');  // Crear un nuevo producto
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');  // Guardar un nuevo producto
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/favorites', [ProductController::class, 'favorites'])->name('products.favorites');
    Route::post('/products/{product}/toggle-favorite', [ProductController::class, 'toggleFavorite'])->name('products.toggleFavorite');
    // Seleccionar un producto
    Route::get('/products/select', [ProductController::class, 'selectForm'])->name('products.selectForm');  // Mostrar formulario de selección
    Route::post('/products/select', [ProductController::class, 'select'])->name('products.select');  // Procesar selección de producto

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');  // Editar un producto existente
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');  // Actualizar un producto
});

// Carrito de compras
// web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show'); // Mostrar el carrito
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add'); // Añadir producto al carrito
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update'); // Actualizar cantidad en el carrito
    Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove'); // Eliminar producto del carrito
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Proceder al pago
    Route::get('/order/invoice/{orderId}', [CartController::class, 'invoice'])->name('order.invoice'); // Mostrar la factura/comprobante});

});
    


require __DIR__ . '/auth.php';
