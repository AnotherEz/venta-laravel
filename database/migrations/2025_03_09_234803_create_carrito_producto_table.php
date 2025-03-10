<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoProductoTable extends Migration
{
    public function up()
    {
        Schema::create('carrito_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrito_id');
            $table->unsignedBigInteger('producto_id');
            $table->string('nombre_producto', 255); // 🔹 Nombre del producto en el momento de la compra
            $table->string('presentacion', 255); // 🔹 Presentación del producto (Ej: Frasco 700mL)
            $table->integer('cantidad')->default(1);
            $table->decimal('precio_normal', 10, 2); // 🔹 Precio normal sin descuento
            $table->decimal('precio_unitario', 10, 2); // 🔹 Precio con descuento aplicado
            $table->decimal('descuento', 10, 2)->default(0.00); // 🔹 Descuento aplicado
            $table->decimal('subtotal', 10, 2)->storedAs('(cantidad * precio_unitario) - descuento'); // 🔹 Subtotal con descuento aplicado

            $table->foreign('carrito_id')->references('id')->on('carrito')->onDelete('cascade');
            $table->foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrito_producto');
    }
}
