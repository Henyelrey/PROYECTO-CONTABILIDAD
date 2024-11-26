@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Agregar Proveedor</h1>
@stop

@section('content')


    <form action="{{ route('proveedores.store') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion">

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono">

        <button type="submit">Guardar</button>
    </form>
@stop

