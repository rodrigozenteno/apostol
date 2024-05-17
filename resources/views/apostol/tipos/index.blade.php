@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de tipos de Unidades</h1>
@endsection

@section('content')
    <a href="{{route('tipos.create')}}" class="btn btn-secondary mb-4">Registrar tipo de unidad</a>
    @if (count($tipos))
        @php
            $i=0;
        @endphp
        <table id="tipos" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>TIPO DE UNIDAD</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($tipos as $tipo)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $tipo->tipo }}</td>
                    <td><a href="{{route('tipos.edit', $tipo->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="tipos" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>TIPO DE UNIDAD</td>
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
            $('#tipos').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection