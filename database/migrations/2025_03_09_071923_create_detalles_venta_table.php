<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesVentaTable extends Migration
{
    public function up()
    {
        Schema::create('detalles_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10,2);
            $table->decimal('subtotal', 10,2)->storedAs('cantidad * precio_unitario');
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalles_venta');
    }
}
