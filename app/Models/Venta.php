<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas'; // Nombre de la tabla
    protected $fillable = [
        'codigo',
        'vendedor',
        'cliente',
        'fecha',
        'hora',
        'comprobante',
        'serie',
        'correlativo',
        'importe',
    ];
}
