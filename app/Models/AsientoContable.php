<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsientoContable extends Model
{
    use HasFactory;
    protected $table = 'asientos_contables';
    protected $fillable = ['compra_id', 'venta_id', 'descripcion', 'proveedor', 'BI','IGV','total', 'debito', 'credito'];

     // Relación con Compra
     public function compra()
     {
         return $this->belongsTo(Compra::class);
     }

     // Relación con Venta
     public function venta()
     {
         return $this->belongsTo(Venta::class);
     }
}
