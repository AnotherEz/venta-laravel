<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Producto;
use App\Models\CarritoProducto;
use App\Models\Carrito;

class ProductoController extends Controller
{
    /**
     * 📌 Obtener todos los productos
     */
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    /**
     * 📌 Buscar productos con `presentacion`
     */
    public function buscar(Request $request)
    {
        \Log::info("Consulta de búsqueda: " . json_encode($request->all()));

        $query = Producto::query();

        if ($request->filled('nombre')) {
            $nombre = trim($request->nombre);
            \Log::info("Buscando por nombre: " . $nombre);
            $query->orWhereRaw("LOWER(nombre_producto) LIKE LOWER(?)", ["%{$nombre}%"]);
        }

        if ($request->filled('categoria')) {
            $categoria = trim($request->categoria);
            \Log::info("Buscando por categoría: " . $categoria);
            $query->orWhereRaw("LOWER(categoria) LIKE LOWER(?)", ["%{$categoria}%"]);
        }

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

    /**
     * 🛒 Agregar producto al carrito con `presentacion`
     */
    public function agregarProductoAlCarrito(Request $request)
    {
        try {
            $validated = $request->validate([
                'carrito_id' => 'required|exists:carrito,id',
                'producto_id' => 'required|exists:productos,id_producto',
                'cantidad' => 'required|integer|min:1',
            ]);

            $producto = Producto::find($validated['producto_id']);

            // Validar stock disponible
            if ($producto->stock_disponible < $validated['cantidad']) {
                return response()->json(['error' => 'Stock insuficiente'], 400);
            }

            // Verificar si el producto ya está en el carrito
            $carritoProducto = CarritoProducto::where([
                'carrito_id' => $validated['carrito_id'],
                'producto_id' => $validated['producto_id']
            ])->first();

            if ($carritoProducto) {
                // Si ya existe, solo incrementar la cantidad
                $carritoProducto->cantidad += $validated['cantidad'];
                $carritoProducto->save();
            } else {
                CarritoProducto::create([
                    'carrito_id' => $validated['carrito_id'],
                    'producto_id' => $validated['producto_id'],
                    'nombre_producto' => $producto->nombre_producto,
                    'presentacion' => $producto->presentacion,
                    'cantidad' => $validated['cantidad'],
                    'precio_normal' => $producto->precio_unitario * $validated['cantidad'], // Multiplicación por cantidad
                    'precio_unitario' => $producto->precio_unitario,
                   
                    'descuento' => $producto->descuento, // Aplicar descuento directamente
                ]);
                
            }

            // Reducir stock del producto
            $producto->stock_disponible -= $validated['cantidad'];
            $producto->save();

            return response()->json(['message' => 'Producto agregado al carrito'], 201);
        } catch (\Exception $e) {
            Log::error("Error al agregar producto al carrito", ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error interno en el servidor'], 500);
        }
    }

    /**
     * ❌ Eliminar producto del carrito y restaurar stock
     */
    public function eliminarProductoDelCarrito(Request $request)
{
    try {
        $validated = $request->validate([
            'carrito_id' => 'required|exists:carrito,id',
            'producto_id' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Buscar el producto en el carrito
        $carritoProducto = CarritoProducto::where([
            'carrito_id' => $validated['carrito_id'],
            'producto_id' => $validated['producto_id']
        ])->first();

        if (!$carritoProducto) {
            return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
        }

        // Obtener el producto para restaurar stock
        $producto = Producto::find($validated['producto_id']);
        if ($producto) {
            $producto->stock_disponible += min($validated['cantidad'], $carritoProducto->cantidad);
            $producto->save();
        }

        // Verificar si hay que eliminar toda la fila o solo reducir la cantidad
        if ($carritoProducto->cantidad > $validated['cantidad']) {
            $carritoProducto->cantidad -= $validated['cantidad'];
            $carritoProducto->save();
            return response()->json(['message' => 'Cantidad eliminada del carrito'], 200);
        } else {
            $carritoProducto->delete();
            return response()->json(['message' => 'Producto eliminado del carrito'], 200);
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => 'Datos inválidos', 'detalles' => $e->errors()], 422);
    } catch (\Exception $e) {
        Log::error("Error al eliminar producto del carrito", ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Error interno en el servidor'], 500);
    }
}

}
