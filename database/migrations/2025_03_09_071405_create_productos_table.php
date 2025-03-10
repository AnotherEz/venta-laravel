
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto'); // PRIMARY KEY
            $table->string('codigo', 50);
            $table->string('nombre_producto', 255);
            $table->string('categoria', 100)->nullable();
            $table->decimal('precio_unitario', 10, 2)->nullable();
            $table->decimal('precio_mayorista', 10, 2)->nullable();
            $table->decimal('descuento', 10, 2)->nullable();
            $table->integer('stock_disponible')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
