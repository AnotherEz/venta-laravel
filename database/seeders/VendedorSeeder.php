<?php
use Illuminate\Database\Seeder;
use App\Models\Vendedor;

class VendedorSeeder extends Seeder
{
    public function run()
    {
        // Insertamos vendedores de ejemplo
        Vendedor::create([
            'nombre' => 'Carlos Pérez',
            'email' => 'carlos@ejemplo.com',
            'telefono' => '999123456',
        ]);

        Vendedor::create([
            'nombre' => 'Ana Gómez',
            'email' => 'ana@ejemplo.com',
            'telefono' => '998765432',
        ]);
    }
}
