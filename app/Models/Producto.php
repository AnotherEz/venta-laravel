<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre correcto de la tabla
    protected $primaryKey = 'id_producto'; // Clave primaria correcta
    public $timestamps = true; // Para manejar created_at y updated_at

    protected $fillable = [
        'codigo',
        'nombre_producto',
        'categoria',
        'precio_unitario',
        'precio_mayorista',
        'descuento',
        'stock_disponible',
        'descripcion',
    ];
}
