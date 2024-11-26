<!DOCTYPE html>
<html>
<head>
    <title>Asiento de Venta</title>
    <style>
 .container {
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
        background-color: #FFFFFF;
        padding: 20px;
        box-sizing: border-box;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        background-color: #9b9b9b;
        color: black;
        padding: 15px;
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 16px;
    }

    .table th, .table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #DDD;
    }

    .table th {
        background-color: #9b9b9b;
        font-weight: bold;
    }

    .table td {
        font-weight: bold;
    }

    .table td:last-child {
        text-align: right;
    }

    .table .total {
        font-size: 18px;
        border-top: 2px solid #000;
    }
    .footer {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
    }
</style>
    </style>
</head>
</head>
<body>
    <div class="container">
        <div class="header">
            ASIENTO DE VENTAS
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>CUENTA</th>
                    <th>DENOMINACIÓN</th>
                    <th>DEBE</th>
                    <th>HABER</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>12</td>
                    <td>CUENTAS POR COBRAR</td>
                    <td>${{ $cuentas_por_cobrar }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>121</td>
                    <td>Factura Boleta</td>
                </tr>
                <tr>
                    <td>40</td>
                    <td>TRIBUTOS</td>
                    <td></td>
                    <td>${{ $tributos_igv }}</td>
                </tr>
                <tr>
                    <td>401</td>
                    <td>Gobierno Central</td>
                </tr>
                <tr>
                    <td>70</td>
                    <td>VENTAS</td>
                    <td></td>
                    <td>${{ $ventas_mercaderias }}</td>
                    
                </tr>
                <tr>
                    <td>701</td>
                    <td>Mercaderias</td>
                </tr>
                <tr class="total">
                    <td>TOTALES</td>
                    <td></td>
                    <td>${{ $total }}</td>
                    <td>${{ $total }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
            <p>Por la venta de la factura 0001-01 Fecha: {{ $fecha . ' ' . $hora }} </p>
    </div>
</body>
</html>
</html>