<?php
// app/Http/Controllers/CarritoController.php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carritos = Carrito::all();
        return response()->json($carritos);
    }

    public function store(Request $request)
    {
        $carrito = Carrito::create($request->all());
        return response()->json($carrito, 201);
    }

    public function show($id)
    {
        $carrito = Carrito::find($id);
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
        return response()->json(null, 204);
    }
}
