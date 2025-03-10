<?php
// app/Http/Controllers/VentaController.php

// app/Http/Controllers/VentaController.php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Método para registrar la venta
    public function registrarVenta(Request $request)
    {
        // Validar los datos
        $request->validate([
            'tipo_venta' => 'required|string',
            'tipo_pago' => 'required|string',
            'monto' => 'required|numeric|min:0',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        // Obtener productos del carrito
        $carrito = Carrito::where('user_id', $request->user_id)->get();
        $total = $carrito->sum('subtotal');
        
        // Verificar el monto del pago
        $this->validarPago($request, $total);

        // Crear la venta
        $venta = new Venta([
            'cliente_id' => $request->cliente_id,
            'vendedor_id' => $request->vendedor_id,  // Usamos el vendedor_id que viene en la solicitud
            'importe_total' => $total,
            'tipo_comprobante' => $request->tipo_venta,
            'serie' => $request->tipo_venta == 'Factura' ? 'F001' : 'B001',
            'correlativo' => $this->generarCorrelativo($request->tipo_venta),
        ]);
        $venta->save();

        // Agregar productos a la venta
        foreach ($carrito as $item) {
            Producto::find($item->producto_id)->decrement('stock_disponible', $item->cantidad);

            // Crear los detalles de la venta
            $venta->detalles()->create([
                'producto_id' => $item->producto_id,
                'cantidad' => $item->cantidad,
                'precio_unitario' => $item->precio_unitario,
                'subtotal' => $item->subtotal,
            ]);
        }

        // Limpiar el carrito después de la venta
        $carrito->each->delete();

        // Mostrar el mensaje de éxito con los datos de la venta
        return response()->json([
            'success' => 'Venta realizada con éxito.',
            'venta' => $venta,
            'detalles' => $venta->detalles,
        ]);
    }

    // Método para generar un correlativo basado en el tipo de venta
    private function generarCorrelativo($tipo_venta)
    {
        $venta = Venta::where('tipo_comprobante', $tipo_venta)->latest()->first();
        return $venta ? $venta->correlativo + 1 : 1001;
    }

    // Validación de pago
    private function validarPago(Request $request, $total)
    {
        if ($request->tipo_pago == 'Efectivo') {
            if ($request->monto < $total) {
                return response()->json(['error' => 'El monto es insuficiente.'], 400);
            }
        } elseif ($request->tipo_pago == 'Tarjeta') {
            if ($request->monto != $total) {
                return response()->json(['error' => 'El monto no coincide con el total.'], 400);
            }
        } elseif ($request->tipo_pago == 'Mixto') {
            if ($request->efectivo + $request->tarjeta != $total) {
                return response()->json(['error' => 'La suma de los montos no es correcta.'], 400);
            }
        }
    }
}
