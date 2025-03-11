<?php
// app/Models/Vendedor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_vendedor';
    protected $table = 'vendedores'; // Aquí defines el nombre completo de la tabla

    protected $fillable = [
        'dni',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email'
    ];

    
}
