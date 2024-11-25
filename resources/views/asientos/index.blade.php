@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Clientes</h1>
@stop

@section('content')
<div class="flex justify-center">
    <div class="overflow-x-auto w-full max-w-6xl"> <!-- Add max-w-6xl to limit width -->
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
            <thead class="bg-blue-600 text-black">
                <tr>
                    <th class="py-3 px-4 text-center">ID</th>
                    <th class="py-3 px-4 text-center">Compra ID</th>
                    <th class="py-3 px-4 text-center">Descripción</th>
                    <th class="py-3 px-4 text-center">BI</th>
                    <th class="py-3 px-4 text-center">IGV</th>
                    <th class="py-3 px-4 text-center">Total</th>
                    <th class="py-3 px-4 text-center">Débito</th>

                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($asientos as $asiento)
                    <tr class="hover:bg-yellow-200">
                        <td class="py-3 px-4 text-center">{{ $asiento->id }}</td>
                        <td class="py-3 px-4 text-center">{{ $asiento->compra_id }}</td>
                        <td class="py-3 px-4 text-center">{{ $asiento->descripcion }}</td>
                        <td class="py-3 px-4 text-center">{{ $asiento->BI }}</td>
                        <td class="py-3 px-4 text-center">{{ $asiento->IGV }}</td>
                        <td class="py-3 px-4 text-center">{{ $asiento->total }}</td>
                        <td class="py-3 px-4 text-center">{{ $asiento->debito }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop

