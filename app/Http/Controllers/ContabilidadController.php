<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class ContabilidadController extends Controller
{
    // Mostrar formulario de compras
    public function showCompraForm()
    {
        return view('compras.compras');
    }



    // YO SIEMRE ESTUVE AHI GATO
    //                - Humpty Dumpty




    // Registrar compra y generar asiento
    public function storeCompra(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'descripcion' => 'required|string|max:255', // Validación para la descripción
            'proveedor_id' => 'required|exists:proveedores,id',

        ]);

        $compra = Compra::create([
            'fecha' => $request->fecha,
            'total' => $request->total,
            'descripcion' => $request->descripcion, // Guardar la descripción
            'proveedor_id' => $request->proveedor_id, // Guardar el proveedor_id

        ]);

        // Llamar a la función para generar el asiento contable de la compra
        $this->generarAsientoCompra($compra);

        return redirect()->route('compras.form')->with('message', 'Compra registrada y asiento generado.');
    }

    // Mostrar formulario de ventas


    // Generar asiento contable para la compra
    private function generarAsientoCompra($compra)
    {



    // Calcular el IGV como el 18% del total
    $igv = $compra->total * 0.18;

    // Calcular el total (compra + IGV)
    $total = $compra->total + $igv;

    // Crear el asiento contable con los valores calculados
    $compra->asientosContables()->create([
        'descripcion' => $compra->descripcion. " Compra reallizada el: ". $compra->fecha,
        'proveedor' => $compra->proveedor_id,
        'debito' => $total,   // El total con IGV
        'credito' => 0,
        'BI' => $compra->total,
        'IGV' => $igv,        // El valor del IGV calculado
        'total' => $total,
         // El valor total (compra + IGV)
    ]);
    }

}
