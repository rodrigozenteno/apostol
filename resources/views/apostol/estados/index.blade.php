@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de estados</h1>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @can('REGISTRAR ESTADO')
        <a href="{{route('estados.create')}}" class="btn btn-secondary mb-4">Registrar estado</a>
    @endcan
    @if (count($estados))
        @php
            $i=0;
        @endphp
        <table id="estados" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ESTADO</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($estados as $estado)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $estado->estado }}</td>
                    <td>
                        @can('EDITAR ESTADO')
                            
                        @endcan
                        <a href="{{route('estados.edit', $estado->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="estados" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ESTADO</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            <tr>
                <td colspan="3" align="center">SIN REGISTRO</td>
            </tr>
        </table>
    @endif
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#estados').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection