<?php
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{   
    


    public function show($carritoId)
{
    // Buscar el carrito con sus productos asociados desde CarritoProducto
    $carrito = Carrito::where('id', $carritoId)
                      ->with('productos') // Relación con CarritoProducto
                      ->first();

    if (!$carrito) {
        return response()->json([
            'message' => 'Carrito no encontrado',
            'productos' => []
        ], 404);
    }

    // Obtener los productos con la información de CarritoProducto
    $productos = $carrito->productos->map(function ($carritoProducto) {
        return [
            'id' => $carritoProducto->producto_id, 
            'nombre' => $carritoProducto->nombre_producto, // Nombre en CarritoProducto
            'codigo' => optional($carritoProducto->producto)->codigo, // Desde la relación Producto
            'categoria' => optional($carritoProducto->producto)->categoria,
            'presentacion' => $carritoProducto->presentacion,
            'cantidad' => $carritoProducto->cantidad,
            'precio_normal' => $carritoProducto->precio_normal,
            'precio_unitario' => $carritoProducto->precio_unitario,
            'descuento' => $carritoProducto->descuento,
            'subtotal' => $carritoProducto->subtotal,
        ];
    });

    return response()->json([
        'id_carrito' => $carrito->id,
        'cliente_id' => $carrito->cliente_id,
        'productos' => $productos,
        'total' => $productos->sum('subtotal')
    ]);
}

    public function store(Request $request)
    {
        $clienteId = $request->input('cliente_id');

        // Verificar si el cliente ya tiene un carrito
        $carrito = Carrito::where('cliente_id', $clienteId)->first();

        if ($carrito) {
            // Si ya tiene un carrito, vaciarlo eliminando todos sus productos
            CarritoProducto::where('carrito_id', $carrito->id)->delete();
        } else {
            // Si no tiene, crear un nuevo carrito
            $carrito = Carrito::create([
                'cliente_id' => $clienteId,
                'fecha_creacion' => now(),
                'estado' => 'activo'
            ]);
        }

        return response()->json($carrito, 201);
    }
}


