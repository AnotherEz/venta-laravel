<?php
// app/Models/Descuento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_descuento';

    protected $fillable = [
        'tipo_descuento',
        'categoria',
        'marca',
        'fecha_inicio',
        'fecha_fin',
        'uso_limitado',
        'estado'
    ];
}
