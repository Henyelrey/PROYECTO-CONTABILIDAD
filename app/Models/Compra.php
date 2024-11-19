<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['fecha', 'total'];

    public function asientosContables()
    {
        return $this->hasMany(AsientoContable::class);
    }
}
