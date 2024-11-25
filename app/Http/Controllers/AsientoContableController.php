<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsientoContable;


class AsientoContableController extends Controller
{
    public function index()
    {
        $asientos = AsientoContable::all(); // Obtén todos los registros
        return view('asientos.index', compact('asientos')); // Pasa los datos a la vista
    }
}
