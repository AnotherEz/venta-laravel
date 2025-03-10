<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'codigo' => 'P001',
                'nombre_producto' => 'Perfume Elixir Ouhoe',
                'categoria' => 'Perfumes',
                'precio_unitario' => 150.00,
                'precio_mayorista' => 120.00,
                'descuento' => 10.00,
                'stock_disponible' => 50,
                'descripcion' => 'Fragancia duradera con notas dulces y amaderadas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'P002',
                'nombre_producto' => 'Serum Up Rejuvenecedor',
                'categoria' => 'Cuidado Personal',
                'precio_unitario' => 90.00,
                'precio_mayorista' => 75.00,
                'descuento' => 5.00,
                'stock_disponible' => 30,
                'descripcion' => 'Sérum facial con colágeno y ácido hialurónico.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'P003',
                'nombre_producto' => 'Golden Lure Fragancia Unisex',
                'categoria' => 'Perfumes',
                'precio_unitario' => 130.00,
                'precio_mayorista' => 110.00,
                'descuento' => 8.00,
                'stock_disponible' => 40,
                'descripcion' => 'Aroma fresco y seductor, ideal para cualquier ocasión.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'P004',
                'nombre_producto' => 'Taboo Mujer Perfume',
                'categoria' => 'Perfumes',
                'precio_unitario' => 140.00,
                'precio_mayorista' => 115.00,
                'descuento' => 12.00,
                'stock_disponible' => 35,
                'descripcion' => 'Perfume femenino con notas florales y frutales.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'P005',
                'nombre_producto' => 'Jabón Exfoliante de Café',
                'categoria' => 'Cuidado Personal',
                'precio_unitario' => 25.00,
                'precio_mayorista' => 20.00,
                'descuento' => 2.00,
                'stock_disponible' => 100,
                'descripcion' => 'Jabón natural con extracto de café para exfoliación profunda.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
