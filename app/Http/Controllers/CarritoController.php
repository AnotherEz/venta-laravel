<?php
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
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
