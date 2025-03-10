<?php
// app/Http/Controllers/CarritoController.php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        return response()->json(Carrito::with('productos')->get());
    }

    public function store(Request $request)
    {
        $carrito = Carrito::create($request->all());
        return response()->json($carrito, 201);
    }

    public function show($id)
    {
        $carrito = Carrito::with('productos')->find($id);
        if (!$carrito) {
            return response()->json(['error' => 'Carrito no encontrado'], 404);
        }
        return response()->json($carrito);
    }

    public function update(Request $request, $id)
    {
        $carrito = Carrito::find($id);
        if (!$carrito) {
            return response()->json(['error' => 'Carrito no encontrado'], 404);
        }
        $carrito->update($request->all());
        return response()->json($carrito);
    }

    public function destroy($id)
    {
        $carrito = Carrito::find($id);
        if (!$carrito) {
            return response()->json(['error' => 'Carrito no encontrado'], 404);
        }
        $carrito->delete();
        return response()->json(['message' => 'Carrito eliminado correctamente'], 204);
    }

    // 🔹 Eliminar un producto específico del carrito
    public function eliminarProducto($productoId)
    {
        $producto = CarritoProducto::find($productoId);
        if (!$producto) {
            return response()->json(['error' => 'Producto en carrito no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(['message' => 'Producto eliminado del carrito'], 200);
    }
}
