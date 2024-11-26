@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asientos de compra</h1>
@stop
<!-- Henyel estuvo aqui -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($asientos as $asiento)
        <div class="col-md-6">
            <div class="card shadow border-secondary">
                <!-- Header -->
                <div class="card-header bg-secondary text-white text-center font-weight-bold">
                    Asiento de compras
                </div>

                <!-- Contenido principal -->
                <div class="card-body">
                    <!-- Información general -->
                    <div class="mb-3">
                        <div class="font-weight-bold">ID:</div>
                        <div>{{ $asiento->id }}</div>
                        <div class="font-weight-bold">Compra ID:</div>
                        <div>{{ $asiento->compra_id }}</div>

                    </div>

                    <!-- Celdas-->
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-3 border text-center p-3">Cta.</div>
                            <div class="col-3 border text-center p-3">Decripcion</div>
                            <div class="col-3 border text-center p-3">Debe</div>
                            <div class="col-3 border text-center p-3">Haber</div>
                        </div>
                        <div class="row">
                            <div class="col-3 border text-center p-3">60<br>601</div>
                            <div class="col-3 border text-center p-3">Compra<br>mercaderia</div>
                            <div class="col-3 border text-center p-3"> BI<br>S/{{ number_format($asiento->BI, 2) }}</div>
                            <div class="col-3 border text-center p-3">---</div>
                        </div>
                        <div class="row">
                            <div class="col-3 border text-center p-3">40</div>
                            <div class="col-3 border text-center p-3">tributos</div>
                            <div class="col-3 border text-center p-3">IGV<br>S/{{ number_format($asiento->IGV, 2) }}</div>
                            <div class="col-3 border text-center p-3">---</div>
                        </div>
                        <div class="row">
                            <div class="col-3 border text-center p-3">42<br>421</div>
                            <div class="col-3 border text-center p-3">Ctas x pagar<br>bol, fact</div>
                            <div class="col-3 border text-center p-3">---</div>
                            <div class="col-3 border text-center p-3">PT<br>S/{{ number_format($asiento->total, 2) }}</div>
                        </div>
                    </div>

                    <!-- Totales -->
                    <div class="border-top pt-3">
                        <h6 class="text-center font-weight-bold text-secondary mb-3">Totales</h6>
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Débito:</span>
                            <span>{{ $asiento->debito }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">Proveedor:</span>
                            <span>{{ $asiento->compra->proveedor->nombre ?? 'Proveedor no encontrado' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light">
                    <p class="mb-1"><strong>Descripción:</strong> {{ $asiento->descripcion }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@stop

