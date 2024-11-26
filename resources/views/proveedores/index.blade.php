@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Lista de Proveedores</h1>
@stop

@section('content')

<a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-4">Agregar Proveedor</a>

<table class="table table-bordered table-striped">
    <thead class="thead-light">
        <tr>
            <th class="text-left">Nombre</th>
            <th class="text-left">Dirección</th>
            <th class="text-left">Teléfono</th>
            <th class="text-left">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->direccion }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td class="d-flex">
                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning btn-sm mr-2">Editar</a>
                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop

