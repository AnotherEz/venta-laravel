<?php

namespace App\Http\Controllers;

use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoProductoController extends Controller
{
    public function store(Request $request)
    {
        $producto = CarritoProducto::create([
            'carrito_id' => $request->carrito_id,
            'producto_id' => $request->producto_id,
            'cantidad' => $request->cantidad
        ]);

        return response()->json($producto, 201);
    }

    public function destroy($id)
    {
        $producto = CarritoProducto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
        }

        $producto->delete();
        return response()->json(['message' => 'Producto eliminado del carrito'], 204);
    }
}
