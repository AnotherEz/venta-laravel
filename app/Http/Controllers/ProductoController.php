<?php
// app/Http/Controllers/ProductoController.php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
   
  

    
    public function buscar(Request $request)
    {
        \Log::info("Consulta de búsqueda: " . json_encode($request->all()));
    
        $query = Producto::query();
    
        // Buscar por nombre (coincidencia parcial e insensible a mayúsculas)
        if ($request->filled('nombre')) {
            $nombre = trim($request->nombre);
            \Log::info("Buscando por nombre: " . $nombre);
            $query->orWhereRaw("LOWER(nombre_producto) LIKE LOWER(?)", ["%{$nombre}%"]);
        }
    
        // Buscar por categoría (coincidencia parcial e insensible a mayúsculas)
        if ($request->filled('categoria')) {
            $categoria = trim($request->categoria);
            \Log::info("Buscando por categoría: " . $categoria);
            $query->orWhereRaw("LOWER(categoria) LIKE LOWER(?)", ["%{$categoria}%"]);
        }
    
        // Buscar por código (ahora permite coincidencias parciales)
        if ($request->filled('codigo')) {
            $codigo = trim($request->codigo);
            \Log::info("Buscando por código parcial: " . $codigo);
            $query->orWhere('codigo', 'LIKE', "%{$codigo}%");
        }
    
        $productos = $query->get();
    
        if ($productos->isEmpty()) {
            \Log::error("Producto no encontrado.");
            return response()->json(["error" => "Producto no encontrado"], 404);
        }
    
        \Log::info("Productos encontrados: " . json_encode($productos));
        return response()->json($productos);
    }
    
    



    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function store(Request $request)
    {
        $producto = Producto::create($request->all());
        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        return response()->json($producto);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->update($request->all());
        return response()->json($producto);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->delete();
        return response()->json(null, 204);
    }
}
