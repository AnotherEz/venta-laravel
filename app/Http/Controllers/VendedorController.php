<?php
// app/Http/Controllers/VendedorController.php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return response()->json($vendedores);
    }

    public function store(Request $request)
    {
        $vendedor = Vendedor::create($request->all());
        return response()->json($vendedor, 201);
    }

    public function show($id)
    {
        $vendedor = Vendedor::find($id);
        if (!$vendedor) {
            return response()->json(['error' => 'Vendedor no encontrado'], 404);
        }
        return response()->json($vendedor);
    }

    public function update(Request $request, $id)
    {
        $vendedor = Vendedor::find($id);
        if (!$vendedor) {
            return response()->json(['error' => 'Vendedor no encontrado'], 404);
        }
        $vendedor->update($request->all());
        return response()->json($vendedor);
    }

    public function destroy($id)
    {
        $vendedor = Vendedor::find($id);
        if (!$vendedor) {
            return response()->json(['error' => 'Vendedor no encontrado'], 404);
        }
        $vendedor->delete();
        return response()->json(null, 204);
    }
}
