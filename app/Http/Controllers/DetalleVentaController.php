<?php
// app/Http/Controllers/DetalleVentaController.php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $detalles = DetalleVenta::all();
        return response()->json($detalles);
    }

    public function store(Request $request)
    {
        $detalle = DetalleVenta::create($request->all());
        return response()->json($detalle, 201);
    }

    public function show($id)
    {
        $detalle = DetalleVenta::find($id);
        if (!$detalle) {
            return response()->json(['error' => 'Detalle de venta no encontrado'], 404);
        }
        return response()->json($detalle);
    }

    public function update(Request $request, $id)
    {
        $detalle = DetalleVenta::find($id);
        if (!$detalle) {
            return response()->json(['error' => 'Detalle de venta no encontrado'], 404);
        }
        $detalle->update($request->all());
        return response()->json($detalle);
    }

    public function destroy($id)
    {
        $detalle = DetalleVenta::find($id);
        if (!$detalle) {
            return response()->json(['error' => 'Detalle de venta no encontrado'], 404);
        }
        $detalle->delete();
        return response()->json(null, 204);
    }
}
