@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ventas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('ventas') }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover display responsive nowrap" width="100%" id="tblVentas">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Base Imponible</th>
                                    <th>IGV</th>
                                    <th>Total</th>
                                    <th>Cliente</th>
                                    <th>Fecha/Hora</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('js')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new DataTable('#tblVentas', {
                responsive: true,
                fixedHeader: true,
                ajax: {
                    url: '{{ route('sales.list') }}',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { 
                        data: 'base_imponible', 
                        render: function(data) {
                            return `S/ ${parseFloat(data).toFixed(2)}`; // Formato moneda
                        }
                    },
                    { 
                        data: 'igv', 
                        render: function(data) {
                            return `S/ ${parseFloat(data).toFixed(2)}`;
                        }
                    },
                    { 
                        data: 'total', 
                        render: function(data) {
                            return `S/ ${parseFloat(data).toFixed(2)}`;
                        }
                    },
                    { data: 'nombre' },
                    { data: 'created_at' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<a class="btn btn-sm btn-primary" target="_blank" href="/venta/' +
                                row.id + '/ticket">Ticket</a>&nbsp;' + 
                                '<a class="btn btn-sm btn-success" href="/venta/' + row.id + '/asientov">Asiento Venta</a>';
                        }

                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
                },
                order: [
                    [0, 'desc']
                ]
            });
        });
    </script>
@stop
