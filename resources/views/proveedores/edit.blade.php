@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Editar Proveedor</h1>
@stop

@section('content')


<form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="{{ $proveedor->nombre }}" required>

    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="{{ $proveedor->direccion }}">

    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="{{ $proveedor->telefono }}">

    <button type="submit">Actualizar</button>
</form>
@stop
