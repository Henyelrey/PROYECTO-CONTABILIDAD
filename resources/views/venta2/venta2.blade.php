<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Registrar Compra</h1>
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="form-group col-md-4">
                <label for="buscarCliente">Buscar Cliente</label>
                <input id="buscarCliente" class="form-control" type="text" placeholder="Buscar Cliente">
                <input id="id_cliente" class="form-control" type="hidden">
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" id="total" name="total" required step="0.01">
            </div>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
        </form>
    </div>

    <!-- Mostrar mensaje de éxito o error -->
    @if(session('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
