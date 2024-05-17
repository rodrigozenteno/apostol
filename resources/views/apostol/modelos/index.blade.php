@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de modelos</h1>
@endsection

@section('content')
    @can('REGISTRAR MODELO')
        <a href="{{route('modelos.create')}}" class="btn btn-secondary mb-4">Registrar modelo</a>
    @endcan
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @php
        $i=0;
    @endphp
    <table id="modelos" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>N°</td>
                <td>MODELO</td>
                <td>CALIBRE</td>
                <td>MARCA</td>
                <td>ACCIONES</td>
            </tr>
        </thead>
        @if (count($modelos))
            @foreach ($modelos as $modelo)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $modelo->modelo }}</td>
                    <td>{{ $modelo->calibre }}</td>
                    <td>{{ $modelo->marca->marca }}</td>
                    <td><a href="{{route('modelos.edit', $modelo->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
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
            $('#modelos').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection