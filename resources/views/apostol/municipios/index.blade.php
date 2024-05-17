@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <h1>Lista de municipios</h1>
@endsection

@section('content')
    @can('REGISTRAR MUNICIPIO')
        <a href="{{route('municipios.create')}}" class="btn btn-secondary mb-4">Registrar municipio</a>
    @endcan
    @php
        $i=0;
    @endphp
    <table id="municipios" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>N°</td>
                <td>MUNICIPIO</td>
                <td>PROVINCIA A LA QUE PERTENECE</td>
                <td>DEPARTAMENTO AL QUE PERTENECE</td>
                <td>ACCIONES</td>
            </tr>
        </thead>
        @if (count($municipios))
            @foreach ($municipios as $municipio)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $municipio->municipio }}</td>
                    <td>{{ $municipio->provincia->provincia }}</td>
                    <td>{{ $municipio->provincia->departamento->departamento }}</td>
                    <td><a href="{{route('municipios.edit', $municipio->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" align="center">SIN REGISTRO</td>
            </tr>
        @endif
    </table>
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#municipios').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection