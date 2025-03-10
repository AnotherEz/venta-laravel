<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentosTable extends Migration
{
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id('id_descuento');
            $table->enum('tipo_descuento', ['liquidacion', 'temporada', 'especial']);
            $table->string('categoria', 100)->nullable();
            $table->string('marca', 100)->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('uso_limitado')->default(1000);
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('descuentos');
    }
}
