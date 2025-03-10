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
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10,2);
            // Usamos storedAs para columna generada (disponible en MySQL 5.7+)
            $table->decimal('subtotal', 10,2)->storedAs('cantidad * precio_unitario');
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
