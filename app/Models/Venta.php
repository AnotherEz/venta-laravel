<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas'; // si es "ventas"
    
    protected $fillable = [
        'vendedor_id',
        'cliente_id',
        'fecha',
        'hora',
        'tipo_comprobante',
        'importe_total',
        'tipo_documento',     // <-- Nuevo campo
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }

    // Relación con Vendedor
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id', 'id_vendedor');
    }

    // Relación con Detalles de Venta
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}
