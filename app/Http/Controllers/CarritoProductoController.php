<?php
// app/Http/Controllers/CarritoProductoController.php

namespace App\Http\Controllers;

use App\Models\CarritoProducto;
use Illuminate\Http\Request;

class CarritoProductoController extends Controller
{
    public function index()
    {
        $items = CarritoProducto::all();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $item = CarritoProducto::create($request->all());
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = CarritoProducto::find($id);
        if (!$item) {
            return response()->json(['error' => 'Elemento de carrito no encontrado'], 404);
        }
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = CarritoProducto::find($id);
        if (!$item) {
            return response()->json(['error' => 'Elemento de carrito no encontrado'], 404);
        }
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = CarritoProducto::find($id);
        if (!$item) {
            return response()->json(['error' => 'Elemento de carrito no encontrado'], 404);
        }
        $item->delete();
        return response()->json(null, 204);
    }
}
