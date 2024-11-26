<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Compania;
use App\Models\Detalleventa;
use App\Models\Venta;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('venta.index');
    }

    public function store(Request $request)
    {
        $datosVenta = $request->all();
    
        $id_cliente = $datosVenta['id_cliente'];
        // Calcular totales
        $total = Cart::subtotal(); // Total con IGV incluido
        if ($total > 0) {
            $userId = Auth::id();
    
            // Cálculo de base imponible e IGV
            $base_imponible = $total / 1.18; // Suponiendo que el IGV es del 18%
            $igv = $total - $base_imponible;
    
            // Crear la venta con los nuevos campos
            $sale = Venta::create([
                'total' => $total,
                'base_imponible' => $base_imponible,
                'igv' => $igv,
                'id_cliente' => $id_cliente,
                'id_usuario' => $userId,
                'cuentas_por_cobrar' => $total,         // Cuentas por cobrar comerciales
                'ventas_mercaderias' => $base_imponible, // Ventas sin IGV
                'tributos_igv' => $igv,                 // Monto del IGV
            ]);
    
            if ($sale) {
                // Registrar los detalles de la venta
                foreach (Cart::content() as $item) {
                    Detalleventa::create([
                        'precio' => $item->price,
                        'cantidad' => $item->qty,
                        'id_producto' => $item->id,
                        'id_venta' => $sale->id
                    ]);
                }
                // Vaciar el carrito
                Cart::destroy();
    
                // Retornar respuesta de éxito
                return response()->json([
                    'title' => 'VENTA GENERADA',
                    'icon' => 'success',
                    'ticket' => $sale->id
                ]);
            }
        } else {
            // Retornar respuesta si el carrito está vacío
            return response()->json([
                'title' => 'CARRITO VACIO',
                'icon' => 'warning'
            ]);
        }
    }
    

    public function ticket($id)
    {
        $data['company'] = Compania::first();

        $data['venta'] = Venta::join('clientes', 'ventas.id_cliente', '=', 'clientes.id')
            ->select('ventas.*', 'clientes.nombre', 'clientes.telefono', 'clientes.direccion')
            ->where('ventas.id', $id)
            ->first();

        $data['productos'] = Detalleventa::join('productos', 'detalleventa.id_producto', '=', 'productos.id')
            ->select('detalleventa.*', 'productos.producto')
            ->where('detalleventa.id_venta', $id)
            ->get();

        $fecha_venta = $data['venta']['created_at'];
        $data['fecha'] = date('d/m/Y', strtotime($fecha_venta));
        $data['hora'] = date('h:i A', strtotime($fecha_venta));
        // Generar el contenido del ticket en HTML
        $html = View::make('venta.ticket', $data)->render();
        //Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // Generar el PDF utilizando laravel-dompdf
        //$pdf = Pdf::loadHTML($html)->setPaper([0, 0, 226.77, 500], 'portrait')->setWarnings(false);
        $pdf = Pdf::loadHTML($html)->setPaper([0, 0, 140, 500], 'portrait')->setWarnings(false);

        return $pdf->stream('ticket.pdf');
    }

    public function show()
    {
        return view('venta.show');
    }

    public function cliente(Request $request)
    {
        $term = $request->get('term');
        $clients = Cliente::where('nombre', 'LIKE', '%' . $term . '%')
            ->select('id', 'nombre AS label', 'telefono', 'direccion')
            ->limit(10)
            ->get();
        return response()->json($clients);
    }
    
    public function asientov($id)
    {
        // Obtener la compañia
        $data['company'] = Compania::first();
    
        // Obtener la venta con sus datos contables
        $data['venta'] = Venta::select('cuentas_por_cobrar', 'ventas_mercaderias', 'tributos_igv', 'total')
            ->where('id', $id)
            ->first();
    
        // Obtener los datos contables
        $data['cuentas_por_cobrar'] = number_format($data['venta']->cuentas_por_cobrar, 2);
        $data['ventas_mercaderias'] = number_format($data['venta']->ventas_mercaderias, 2);
        $data['tributos_igv'] = number_format($data['venta']->tributos_igv, 2);
        $data['total'] = number_format($data['venta']->total, 2);
        $fecha_venta = $data['venta']['created_at'];
        $data['fecha'] = date('d/m/Y', strtotime($fecha_venta));
        $data['hora'] = date('h:i A', strtotime($fecha_venta));
    
        // Generar el contenido del asiento contable en HTML
        $html = View::make('venta.asientov', $data)->render();
    
        // Configuración para la generación del PDF
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    
        // Generar el PDF utilizando laravel-dompdf
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait')->setWarnings(false);
    
        return $pdf->stream('asientov.pdf');
    }
    
    
}
