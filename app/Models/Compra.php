<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'total', 'descripcion', 'proveedor_id'];

    public function asientosContables()
    {
        return $this->hasMany(AsientoContable::class);
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class); // Relación inversa, pertenece a un proveedor
    }
    public function showAsientos()
{
    $asientos = AsientoContable::with('compra.proveedor')->get(); // Carga la compra y el proveedor
    return view('asientos.index', compact('asientos'));
}
}
