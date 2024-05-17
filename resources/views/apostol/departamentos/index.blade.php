@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de departamentos</h1>
@endsection

@section('content')
    @can('REGISTRAR DEPARTAMENTO')
        <a href="{{route('departamentos.create')}}" class="btn btn-secondary mb-4">Registrar departamento</a>
    @endcan
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @php
        $i=0;
    @endphp
    <table id="departamentos" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>N°</td>
                <td>DEPARTAMENTO</td>
                <td>ACCIONES</td>
            </tr>
        </thead>
        @if (count($departamentos))
            @foreach ($departamentos as $departamento)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $departamento->departamento }}</td>
                    <td><a href="{{route('departamentos.edit', $departamento->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" align="center">SIN REGISTRO</td>
            </tr>
        @endif
    </table>
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#departamentos').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection