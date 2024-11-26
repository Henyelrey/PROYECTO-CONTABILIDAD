<!DOCTYPE html>
<html>

<head>
    <title>Reporte ticket</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 140pt;
            padding: 1px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 0px;
        }

        .logo img {
            max-width: 50px;
            height: auto;
        }

        .business-info {
            text-align: center;
            font-size: 14px;
        }

        .ticket-details {
            margin-top: 20px;
            padding-top: 10px;
        }

        .ticket-details h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .ticket-details p {
            font-size: 12px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 1px;
            text-align: left;
            font-size: 11px;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="business-info">
            <h3>{{$company->nombre}}</h3>
            <p>{{$company->direccion}}</p>
            <p>{{$company->telefono}}</p>
            <p>{{$company->correo}}</p>
        </div>
        <div class="ticket-details">
            <p>Fecha: {{ $fecha . ' ' . $hora }}</p>
            <p>Folio: {{ $venta->id }}</p>
            <hr>
            <p>Cliente: {{ $venta->nombre }}</p>
            <p>Teléfono: {{ $venta->telefono }}</p>
            <p>Dirección: {{ $venta->direccion }}</p>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>Cant</th>
                        <th>Producto</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">==================================</td>
                    </tr>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->cantidad }}</td>
                            <td>{{ $producto->producto }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">==================================</td>
                    </tr>
                    <tr>
                        <td colspan="2">Total</td>
                        <td><h4>${{ number_format($venta->total, 2) }}</h4></td>
                    </tr>
                    <!-- Agregamos el cálculo de Base Imponible e IGV -->
                    @php
                        $baseImponible = $venta->total / 1.18; // Suponemos un 18% de IGV
                        $igv = $venta->total - $baseImponible;
                    @endphp
                    <tr>
                        <td colspan="2">Base Imponible</td>
                        <td>${{ number_format($baseImponible, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">IGV (18%)</td>
                        <td>${{ number_format($igv, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>

@php
    header("Content-type: application/pdf");
@endphp
