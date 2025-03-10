<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedoresTable extends Migration
{
    public function up()
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id('id_vendedor');
            $table->char('dni', 11)->nullable();
            $table->string('nombres', 255);
            $table->string('apellido_paterno', 255)->nullable();
            $table->string('apellido_materno', 255)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendedores');
    }
}
