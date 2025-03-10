<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    use HasFactory;

    protected $table = 'carrito_producto';

    protected $fillable = [
        'carrito_id',
        'producto_id',
        'nombre_producto',
        'presentacion',
        'cantidad',
        'precio_normal',
        'precio_unitario',
        'descuento'
    ];

    protected $casts = [
        'precio_normal' => 'decimal:2',
        'precio_unitario' => 'decimal:2',
        'descuento' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }

    public function getSubtotalAttribute()
    {
        return ($this->cantidad * $this->precio_unitario) - $this->descuento;
    }
}
