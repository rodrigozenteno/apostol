@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de especialidades</h1>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @can('REGISTRAR ESPECIALIDAD')
        <a href="{{route('especialidads.create')}}" class="btn btn-secondary mb-4">Registrar especialidad</a>
    @endcan
    @if (count($especialidads))
        @php
            $i=0;
        @endphp
        <table id="especialidads" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ESPECIALIDAD</td>
                    <td>ABREVIACIÓN</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($especialidads as $especialidad)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $especialidad->especialidad }}</td>
                    <td>{{ $especialidad->abreviacion }}</td>
                    <td><a href="{{route('especialidads.edit', $especialidad->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="especialidads" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ESPECIALIDAD</td>
                    <td>ABREVIACIÓN</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            <tr>
                <td colspan="4" align="center">SIN REGISTRO</td>
            </tr>
        </table>
    @endif
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#especialidads').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection