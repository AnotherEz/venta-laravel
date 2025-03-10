<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReniecService;
use App\Models\Cliente;
use App\Models\Carrito;
use App\Models\CarritoProducto;
use Illuminate\Database\QueryException;
use Exception;
use Log;

class ReniecController extends Controller
{
    protected $reniecService;

    public function __construct(ReniecService $reniecService)
    {
        $this->reniecService = $reniecService;
    }

    public function buscarDni($dni)
    {
        try {
            // 🔍 Validación básica del DNI
            if (!is_numeric($dni) || strlen($dni) !== 8) {
                return response()->json(['error' => 'DNI inválido'], 400);
            }

            // 🔍 Verificar si el cliente ya existe
            $cliente = Cliente::where('dni_ruc', $dni)->first();
            if ($cliente) {
                // 📌 Si el cliente existe, gestionar su carrito sin afectar la respuesta
                $this->gestionarCarrito($cliente->id_cliente);
                return response()->json($cliente);
            }

            // 🔍 Llamar a la API de RENIEC
            $data = $this->reniecService->getDniData($dni);

            // 📌 Debug: Imprime lo que devuelve la API
            Log::info('Respuesta de RENIEC:', (array) $data);

            // 🔍 Verificar si la API devolvió datos correctos
            if (!isset($data['nombres']) || !isset($data['apellido_paterno']) || !isset($data['apellido_materno'])) {
                return response()->json(['error' => 'DNI no encontrado o respuesta inválida'], 404);
            }

            // 🆕 Crear nuevo cliente
            $nuevoCliente = Cliente::create([
                'dni_ruc' => $dni,
                'nombre_cliente' => "{$data['nombres']} {$data['apellido_paterno']} {$data['apellido_materno']}",
                'contador_compras' => 0,
            ]);

            // 📌 Gestionar su carrito (crear si no tiene)
            $this->gestionarCarrito($nuevoCliente->id_cliente);

            return response()->json($nuevoCliente, 201);
        } catch (QueryException $e) {
            Log::error('Error en base de datos: ' . $e->getMessage());
            return response()->json(['error' => 'Error de base de datos'], 500);
        } catch (Exception $e) {
            Log::error('Error en buscarDni: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    /**
     * 📌 Gestiona el carrito del cliente:
     * - Si no tiene carrito, se crea uno nuevo.
     * - Si ya tiene, se vacía (eliminando todos los productos).
     */
    private function gestionarCarrito($clienteId)
    {
        try {
            $carrito = Carrito::where('cliente_id', $clienteId)->first();

            if ($carrito) {
                // Si ya tiene carrito, eliminar todos sus productos
                CarritoProducto::where('carrito_id', $carrito->id)->delete();
            } else {
                // Si no tiene, crear un nuevo carrito
                Carrito::create([
                    'cliente_id' => $clienteId,
                    'fecha_creacion' => now(),
                    'estado' => 'activo'
                ]);
            }
        } catch (Exception $e) {
            Log::error("Error al gestionar carrito del cliente $clienteId: " . $e->getMessage());
        }
    }
}
