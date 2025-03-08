<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;

class VentaSeeder extends Seeder
{
    public function run()
    {
        Venta::insert([
            [
                'codigo' => 'TA0001',
                'vendedor' => 'Juan Pérez',
                'cliente' => 'Empresa A',
                'fecha' => '2024-03-01',
                'hora' => '09:15:00',
                'comprobante' => 'Boleta',
                'serie' => 'B001',
                'correlativo' => 1000,
                'importe' => 150.00
            ],
            [
                'codigo' => 'TA0002',
                'vendedor' => 'María López',
                'cliente' => 'Cliente B',
                'fecha' => '2024-03-02',
                'hora' => '10:30:00',
                'comprobante' => 'Factura',
                'serie' => 'F002',
                'correlativo' => 1001,
                'importe' => 350.50
            ],
            [
                'codigo' => 'TA0003',
                'vendedor' => 'Carlos Gómez',
                'cliente' => 'Negocio C',
                'fecha' => '2024-03-03',
                'hora' => '14:45:00',
                'comprobante' => 'Boleta',
                'serie' => 'B003',
                'correlativo' => 1002,
                'importe' => 120.90
            ],
        ]);
    }
}
