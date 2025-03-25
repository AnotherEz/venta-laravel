<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendedor_id' => 'required|exists:vendedores,id_vendedor',
            'cliente_id' => 'required|exists:clientes,id_cliente',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i:s', 
            'tipo_comprobante' => 'required|string',
            'importe_total' => 'required|numeric',
        ]);
    
        // Creamos la venta
        $venta = Venta::create($validated);
    
        // Devuelve la venta 
        return response()->json([
            'venta' => $venta
        ], 201);
    }

    public function index()
{
    $ventas = Venta::with(['cliente', 'vendedor'])->get();


    $ventasTransformadas = $ventas->map(function ($venta) {
        
        $nombreVendedor = ($venta->vendedor) 
            ? $venta->vendedor->nombres . ' ' . $venta->vendedor->apellido_paterno . ' ' . $venta->vendedor->apellido_materno
            : 'Sin vendedor';

        return [
            'id' => $venta->id,
            'fecha' => $venta->fecha,
            'hora' => $venta->hora,
            'tipo_comprobante' => $venta->tipo_comprobante,
            'importe_total' => $venta->importe_total,
            'cliente_id' => $venta->cliente_id,
            'vendedor_id' => $venta->vendedor_id,
            'nombreCliente' => $venta->cliente->nombre_cliente ?? 'Sin cliente',
            'nombreVendedor' => $nombreVendedor, // Aquí ya está concatenado
        ];
    });

    return response()->json($ventasTransformadas);
}

    
    

}
