<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoTable extends Migration
{
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->enum('estado', ['activo', 'finalizado'])->default('activo');
            $table->foreign('cliente_id')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carrito');
    }
}
