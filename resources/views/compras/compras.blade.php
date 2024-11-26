@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
    <div class="container mt-5">
        <h1>Registrar Asientos</h1>
        <form action="{{ route('compras.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3 col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3 col-md-5">
                        <label for="total" class="form-label">Ingrese la base imponible</label>
                        <input type="number" class="form-control" id="total" name="total" required step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" required
                            maxlength="255">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar asiento</button>
        </form>
    </div>

    <!-- Mostrar mensaje de éxito o error -->
    @if (session('message'))
        <div class="alert alert-success mt-3">{{ session('message') }}</div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

@stop
