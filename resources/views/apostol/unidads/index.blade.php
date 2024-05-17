@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"> {{-- PARA QUE LA COLUMNA OPCIONES NO TENGA SALTO DE LÍNEA --}}
@endsection

@section('content_header')
    <h1>Lista de Unidades</h1>
@endsection

@section('content')
    <a href="{{route('unidads.create')}}" class="btn btn-secondary mb-4">Registrar Unidad</a>
    @php
        $i=0;
    @endphp
    <table id="unidads" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>N°</td>
                <td>UNIDAD</td>
                <td>ABREVIACIÓN DEL NOMBRE</td>
                <td>OPCIONES</td>
            </tr>
        </thead>
        @if (count($unidads))
            @foreach ($unidads as $unidad)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $unidad->unidad }}</td>
                    <td>{{ $unidad->abrev }}</td>
                    <td>
                        <a href="{{route('unidads.show', $unidad->id)}}" class="btn btn-secondary" title="VER UNIDAD"><i class="fas fa-fsolid fa-eye"></i></a>
                        <a href="{{route('unidads.edit', $unidad->id)}}" class="btn btn-secondary" title="EDITAR"><i class="fas fa-solid fa-pen"></i></a>
                        <a href="{{route('destinos.index_destinados', $unidad->id)}}" class="btn btn-secondary" title="PERSONAL DESTINADO"><i class="fas fa-solid fa-user"></i></a>
                        <a href="{{route('destinos.index_destinados_uu_dd', $unidad->id)}}" class="btn btn-primary" title="PERSONAL DESTINADO CON UU.DD."><i class="fas fa-solid fa-user"></i></a>
                        <a href="{{route('unidads.novedads', $unidad->id)}}" class="btn btn-secondary" title="NOVEDADES DEL DÍA"><i class="fas fa-regular fa-clipboard"></i></a>
                        <a href="{{route('unidads.novedads_uu_dd', $unidad->id)}}" class="btn btn-primary" title="NOVEDADES DEL DÍA CON UU.DD."><i class="fas fa-regular fa-clipboard"></i></a>
                        <a href="{{route('unidads.novedads_fechas', $unidad->id)}}" class="btn btn-secondary" title="NOVEDADES POR FECHAS"><i class="fas fa-regular fa-calendar"></i></a>
                        <a href="{{route('unidads.novedads_fechas', $unidad->id)}}" class="btn btn-primary" title="NOVEDADES POR FECHAS CON UU.DD."><i class="fas fa-regular fa-calendar"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" align="center">SIN REGISTRO</td>
            </tr>
        @endif
    </table>
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#unidads').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection