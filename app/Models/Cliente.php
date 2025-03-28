<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Asegurar que la tabla se usa correctamente
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'dni_ruc',
        'nombre_cliente',
        'contador_compras'
    ];
}
