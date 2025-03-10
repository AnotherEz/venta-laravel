<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReniecService;
use App\Models\Cliente; // Importar el modelo Cliente

class ReniecController extends Controller
{
    protected $reniecService;

    public function __construct(ReniecService $reniecService)
    {
        $this->reniecService = $reniecService;
    }

    public function buscarDni($dni)
    {
        // 🔍 Verificar si el cliente ya existe
        $cliente = Cliente::where('dni_ruc', $dni)->first();
        if ($cliente) {
            return response()->json($cliente);
        }
    
        // 🔍 Llamar a la API de RENIEC
        $data = $this->reniecService->getDniData($dni);
    
        // 📌 Debug: Imprime lo que devuelve la API
        \Log::info('Respuesta de RENIEC:', $data);
    
        // 🔍 Verificar si la API devolvió datos correctos
        if (!isset($data['nombres']) || !isset($data['apellido_paterno']) || !isset($data['apellido_materno'])) {
            return response()->json(['error' => 'DNI no encontrado o respuesta inválida'], 404);
        }
    
        // 🆕 Crear nuevo cliente si no existe
        $nuevoCliente = Cliente::create([
            'dni_ruc' => $dni,
            'nombre_cliente' => "{$data['nombres']} {$data['apellido_paterno']} {$data['apellido_materno']}",
            'contador_compras' => 0,
        ]);
    
        return response()->json($nuevoCliente, 201);
    }
    
}
