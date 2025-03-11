<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendedor_id');
            $table->unsignedBigInteger('cliente_id');
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo_comprobante', 50);
            $table->decimal('importe_total', 10, 2);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('vendedor_id')->references('id_vendedor')->on('vendedores')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id_cliente')->on('clientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
