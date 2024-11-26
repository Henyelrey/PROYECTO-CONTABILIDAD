<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
  protected $fillable = ['total','base_imponible','igv','id_cliente','id_usuario','cuentas_por_cobrar','ventas_mercaderias','tributos_igv'];

  public function detalleventa()
  {
    return $this->hasMany(Detalleventa::class);
  }
  public function asientosContables()
    {
        return $this->hasMany(AsientoContable::class);
    }
}
