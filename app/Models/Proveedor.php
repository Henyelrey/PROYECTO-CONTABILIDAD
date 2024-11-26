<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Si quieres permitir la asignación masiva de campos, agrega los campos aquí
    protected $fillable = ['nombre', 'direccion', 'telefono']; // Ajusta los campos según tu estructura

    protected $table = 'proveedores'; // Asegúrate de que el nombre coincida con el de la base de datos

    // Relación con las compras
    public function compras()
    {
        return $this->hasMany(Compra::class); // Un proveedor tiene muchas compras
    }
}
