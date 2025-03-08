<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // ID de la venta
            $table->string('vendedor'); // Nombre del vendedor
            $table->string('cliente'); // Nombre del cliente
            $table->date('fecha'); // Fecha de la venta
            $table->time('hora'); // Hora de la venta
            $table->string('comprobante'); // Tipo de comprobante (Boleta/Factura)
            $table->string('serie'); // Serie del comprobante
            $table->integer('correlativo'); // Número de comprobante
            $table->decimal('importe', 10, 2); // Importe total
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
