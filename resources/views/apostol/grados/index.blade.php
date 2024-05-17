@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de grados</h1>
@endsection

@section('content')
    @can('REGISTRAR GRADO')
        <a href="{{route('grados.create')}}" class="btn btn-secondary mb-4">Registrar grado</a>
    @endcan
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @php
        $i=0;
    @endphp
    <table id="grados" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>N°</td>
                <td>GRADO</td>
                <td>ABREVIACIÓN</td>
                <td>ESCALAFÓN AL QUE PERTENECE</td>
                <td>ACCIONES</td>
            </tr>
        </thead>
        @if (count($grados))
            @foreach ($grados as $grado)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $grado->grado }}</td>
                    <td>{{ $grado->abreviacion }}</td>
                    <td>{{ $grado->escalafon->escalafon }}</td>
                    <td><a href="{{route('grados.edit', $grado->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
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
            $('#grados').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection