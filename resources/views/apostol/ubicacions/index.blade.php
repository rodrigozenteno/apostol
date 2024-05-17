@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de ubicaciones</h1>
@endsection

@section('content')
    <a href="{{route('ubicacions.create')}}" class="btn btn-secondary mb-4">Registrar ubicación</a>
    @if (count($ubicacions))
        @php
            $i=0;
        @endphp
        <table id="ubicacions" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>UBICACIÓN</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($ubicacions as $ubicacion)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $ubicacion->ubicacion }}</td>
                    <td><a href="{{route('ubicacions.edit', $ubicacion->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="ubicacions" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>UBICACIÓN</td>
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
            $('#ubicacions').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection