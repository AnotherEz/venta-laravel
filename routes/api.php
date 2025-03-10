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

Route::apiResource('ventas', VentaController::class);
Route::apiResource('clientes', ClienteController::class);
Route::apiResource('vendedores', VendedorController::class);
Route::apiResource('descuentos', DescuentoController::class);
Route::apiResource('carrito', CarritoController::class);
Route::apiResource('carrito-producto', CarritoProductoController::class);
Route::apiResource('detalles-venta', DetalleVentaController::class);

// 📌 Rutas personalizadas

// Procesar pago
Route::post('/pago', [PagoController::class, 'procesarPago']);

// Registrar venta
Route::post('/venta', [VentaController::class, 'registrarVenta']);

Route::get('productos/buscar', [ProductoController::class, 'buscar']); // 🔹 Debe estar antes
Route::apiResource('productos', ProductoController::class);
// Consultar DNI en RENIEC
Route::get('/reniec/{dni}', [ReniecController::class, 'buscarDni']);
