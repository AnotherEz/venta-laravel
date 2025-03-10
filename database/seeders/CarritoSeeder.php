<?php
use Illuminate\Database\Seeder;
use App\Models\Carrito;
use App\Models\Producto; // Asegúrate de importar el modelo Producto

class CarritoSeeder extends Seeder
{
    public function run()
    {
        // Obtenemos algunos productos de ejemplo
        $producto1 = Producto::first(); // O puedes usar un producto específico si ya tienes registros
        $producto2 = Producto::skip(1)->first(); // O el siguiente producto

        // Insertamos datos de prueba en la tabla 'carrito'
        Carrito::create([
            'producto_id' => $producto1->id,  // Usamos el ID del primer producto
            'cantidad' => 2,
            'precio_unitario' => $producto1->precio_unitario,
            'subtotal' => $producto1->precio_unitario * 2,
        ]);

        Carrito::create([
            'producto_id' => $producto2->id,  // Usamos el ID del segundo producto
            'cantidad' => 3,
            'precio_unitario' => $producto2->precio_unitario,
            'subtotal' => $producto2->precio_unitario * 3,
        ]);
    }
}
