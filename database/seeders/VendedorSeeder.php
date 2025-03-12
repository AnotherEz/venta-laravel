<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendedor;

class VendedorSeeder extends Seeder
{
    public function run()
    {
        Vendedor::create([
            'dni' => '74589624',
            'nombres' => 'Eduardo',
            'apellido_paterno' => 'Fernandez',
            'apellido_materno' => 'Flores',
            'telefono' => '923851639',
            'email' => 'fernandez@gmail.com'
        ]);
    }
}
