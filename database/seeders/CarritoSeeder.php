<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrito;
use App\Models\Cliente;
use Carbon\Carbon;

class CarritoSeeder extends Seeder
{
    public function run()
    {
        // Obtener el cliente con dni_ruc igual a 00000000
        $cliente = Cliente::where('dni_ruc', '00000000')->first(); 

        // Verificar si el cliente existe
        if ($cliente) {
            // Crear un carrito para ese cliente
            Carrito::create([
                'cliente_id' => $cliente->id_cliente, // Usar el id_cliente del cliente
                'fecha_creacion' => Carbon::now(),
                'estado' => 'activo' // Estado inicial del carrito
            ]);
        } else {
            // Si el cliente no existe, mostrar un mensaje de advertencia
            $this->command->warn('No se encontró un cliente con dni_ruc igual a 00000000.');
        }
    }
}
