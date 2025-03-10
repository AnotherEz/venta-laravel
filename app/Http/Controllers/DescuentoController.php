<?php
// app/Http/Controllers/DescuentoController.php

namespace App\Http\Controllers;

use App\Models\Descuento;
use Illuminate\Http\Request;

class DescuentoController extends Controller
{
    public function index()
    {
        $descuentos = Descuento::all();
        return response()->json($descuentos);
    }

    public function store(Request $request)
    {
        $descuento = Descuento::create($request->all());
        return response()->json($descuento, 201);
    }

    public function show($id)
    {
        $descuento = Descuento::find($id);
        if (!$descuento) {
            return response()->json(['error' => 'Descuento no encontrado'], 404);
        }
        return response()->json($descuento);
    }

    public function update(Request $request, $id)
    {
        $descuento = Descuento::find($id);
        if (!$descuento) {
            return response()->json(['error' => 'Descuento no encontrado'], 404);
        }
        $descuento->update($request->all());
        return response()->json($descuento);
    }

    public function destroy($id)
    {
        $descuento = Descuento::find($id);
        if (!$descuento) {
            return response()->json(['error' => 'Descuento no encontrado'], 404);
        }
        $descuento->delete();
        return response()->json(null, 204);
    }
}
