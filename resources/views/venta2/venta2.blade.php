@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
<div class="table-responsive">
    <table class="table table-striped table-hover display responsive nowrap" width="100%" id="tblClients">
        <thead class="thead">
            <tr>
                <th>Id</th>
                <th>compra id</th>
                <th>venta id</th>
                <th>Descripcion</th>
                <th>base imponible</th>
                <th>IGV</th>
                <th>Precio total</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($asientos as $asiento)!-- Iterar sobre la variable $ventas2 y usar $compra -->
                <tr>
                    <td>{{ $compra->id }}</td> <!-- Acceder a los datos de $compra -->
                    <td>{{ $compra->compra_id }}</td>
                    <td>{{ $compra->venta_id }}</td>
                    <td>{{ $compra->descripcion }}</td>
                    <td>{{ $compra->BI }}</td>
                    <td>{{ $compra->IGV }}</td>
                    <td>{{ $compra->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop