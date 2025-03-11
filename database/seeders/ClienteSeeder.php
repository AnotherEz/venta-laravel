<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        Cliente::create([
            'dni_ruc' => '00000000',
            'nombre_cliente' => '',
            'contador_compras' => 0
        ]);
    }
}
