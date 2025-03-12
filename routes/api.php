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

// Rutas relacionadas con Ventas
Route::get('/ventas', [VentaController::class, 'index']); // Mostrar todas las ventas
Route::post('/ventas', [VentaController::class, 'store']); // Crear una nueva venta

// Rutas relacionadas con el Carrito de Compras
Route::get('/carrito/{carritoId}', [CarritoController::class, 'show']); // Mostrar el carrito de compras con el ID especificado

// Rutas relacionadas con Clientes
Route::apiResource('clientes', ClienteController::class); // Operaciones CRUD para clientes
Route::get('/ruc/{ruc}', [ReniecController::class, 'buscarRuc']); // Consultar cliente por RUC
Route::get('/reniec/{dni}', [ReniecController::class, 'buscarDni']); // Consultar cliente por DNI

// Rutas relacionadas con Productos
Route::apiResource('productos', ProductoController::class); // Operaciones CRUD para productos
Route::get('/productos/buscar', [ProductoController::class, 'buscar']); // Buscar productos por criterio

// Rutas relacionadas con el Carrito (Asegurando que no haya conflictos)
Route::post('/carrito/agregar', [ProductoController::class, 'agregarProductoAlCarrito']); // Agregar producto al carrito
Route::delete('/carrito/eliminar', [ProductoController::class, 'eliminarProductoDelCarrito']); // Eliminar producto del carrito

// Rutas relacionadas con Carrito de Compras
Route::apiResource('carrito', CarritoController::class); // Operaciones CRUD para carrito
Route::apiResource('carrito-producto', CarritoProductoController::class); // Operaciones CRUD para productos dentro del carrito

// Rutas relacionadas con Ventas y Detalles de Venta
Route::apiResource('ventas', VentaController::class); // Operaciones CRUD para ventas
Route::apiResource('detalles-venta', DetalleVentaController::class); // Operaciones CRUD para detalles de venta
Route::post('/venta', [VentaController::class, 'registrarVenta']); // Registrar una venta

// Rutas relacionadas con Vendedores y Descuentos
Route::apiResource('vendedores', VendedorController::class); // Operaciones CRUD para vendedores
Route::apiResource('descuentos', DescuentoController::class); // Operaciones CRUD para descuentos
