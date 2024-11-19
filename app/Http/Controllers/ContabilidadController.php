<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Venta;
use Illuminate\Http\Request;

class ContabilidadController extends Controller
{
    // Mostrar formulario de compras
    public function showCompraForm()
    {
        return view('compras.compras');
    }

    // Registrar compra y generar asiento
    public function storeCompra(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $compra = Compra::create([
            'fecha' => $request->fecha,
            'total' => $request->total,
        ]);

        // Llamar a la función para generar el asiento contable de la compra
        $this->generarAsientoCompra($compra);

        return redirect()->route('compras.form')->with('message', 'Compra registrada y asiento generado.');
    }

    // Mostrar formulario de ventas
    public function showVentaForm()
    {
        return view('venta2.venta2');
    }

    // Registrar venta y generar asiento
    public function storeVenta(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $venta = Venta::create([
            'fecha' => $request->fecha,
            'total' => $request->total,
        ]);

        // Llamar a la función para generar el asiento contable de la venta
        $this->generarAsientoVenta($venta);

        return redirect()->route('ventas.form')->with('message', 'Venta registrada y asiento generado.');
    }

    // Generar asiento contable para la compra
    private function generarAsientoCompra($compra)
    {



    // Calcular el IGV como el 18% del total
    $igv = $compra->total * 0.18;

    // Calcular el total (compra + IGV)
    $total = $compra->total + $igv;

    // Crear el asiento contable con los valores calculados
    $compra->asientosContables()->create([
        'descripcion' => 'Compra realizada el ' . $compra->fecha,
        'debito' => $total,   // El total con IGV
        'credito' => 0,
        'BI' => $compra->total,
        'IGV' => $igv,        // El valor del IGV calculado
        'total' => $total,    // El valor total (compra + IGV)
    ]);
    }

    // Generar asiento contable para la venta
    private function generarAsientoVenta($venta)
    {
        $igv = $venta->total * 0.18;

        // Calcular el total (compra + IGV)
        $total = $venta->total + $igv;

        // Crear el asiento contable con los valores calculados
        $venta->asientosContables()->create([
            'descripcion' => 'Compra realizada el ' . $venta->fecha,
            'debito' => 0,   // El total con IGV
            'credito' => $total,
            'BI' => $venta->total,
            'IGV' => $igv,        // El valor del IGV calculado
            'total' => $total,    // El valor total (compra + IGV)
        ]);
    }
}
