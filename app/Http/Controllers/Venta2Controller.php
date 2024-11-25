<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Venta2Controller extends Controller
{

    public function mostrarVentas()
{
    $ventas2 = Venta::all(); // O cualquier valor que necesites
    return view('ventas', compact('ventas2')); // Pasando la variable a la vista
}

}