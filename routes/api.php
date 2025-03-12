<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReniecController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\CarritoProductoController;
use App\Http\Controllers\DetalleVentaController;

Route::get('/ventas', [VentaController::class, 'index']);

Route::post('/ventas', [VentaController::class, 'store']);


Route::get('/carrito/{carritoId}', [CarritoController::class, 'show']);

// Rutas relacionadas con Clientes
Route::apiResource('clientes', ClienteController::class);
Route::get('/ruc/{ruc}', [ReniecController::class, 'buscarRuc']);
Route::get('/reniec/{dni}', [ReniecController::class, 'buscarDni']); // 🔍 Consulta DNI

// Rutas relacionadas con Productos
Route::apiResource('productos', ProductoController::class);
Route::get('/productos/buscar', [ProductoController::class, 'buscar']); // 🔎 Buscar productos

// Rutas relacionadas con el Carrito (MOVIDAS ARRIBA PARA EVITAR CONFLICTOS)
Route::post('/carrito/agregar', [ProductoController::class, 'agregarProductoAlCarrito']); // ➕ Agregar producto al carrito
Route::delete('/carrito/eliminar', [ProductoController::class, 'eliminarProductoDelCarrito']); // ❌ Eliminar producto del carrito

// Rutas relacionadas con Carrito de Compras (SE MUEVEN ABAJO PARA NO INTERFERIR)
Route::apiResource('carrito', CarritoController::class);
Route::apiResource('carrito-producto', CarritoProductoController::class);

// Rutas relacionadas con Ventas
Route::apiResource('ventas', VentaController::class);
Route::apiResource('detalles-venta', DetalleVentaController::class);
Route::post('/venta', [VentaController::class, 'registrarVenta']); // 📌 Registrar venta

// Rutas relacionadas con Vendedores y Descuentos
Route::apiResource('vendedores', VendedorController::class);
Route::apiResource('descuentos', DescuentoController::class);
