<?php
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        // Insertamos clientes de ejemplo
        Cliente::create([
            'nombre' => 'Luis Martínez',
            'email' => 'luis@cliente.com',
            'telefono' => '987654321',
            'direccion' => 'Av. Los Pinos 123, Trujillo',
        ]);

        Cliente::create([
            'nombre' => 'María Rodríguez',
            'email' => 'maria@cliente.com',
            'telefono' => '982345678',
            'direccion' => 'Calle Sol 456, Trujillo',
        ]);
    }
}
