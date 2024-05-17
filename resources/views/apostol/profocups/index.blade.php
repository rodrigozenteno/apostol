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
    <h1>Lista de Profesiones/Ocupaciones</h1>
@endsection

@section('content')
    @can('REGISTRAR PROFESIÓN U OCUPACIÓN')
        <a href="{{route('profocups.create')}}" class="btn btn-secondary mb-4">Registrar Profesión/Ocupación</a>
    @endcan
    
    @if (count($profocups))
        @php
            $i=0;
        @endphp
        <table id="profocups" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>PROFESIÓN/OCUPACIÓN</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($profocups as $profocup)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $profocup->profocup }}</td>
                    <td><a href="{{route('profocups.edit', $profocup->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="profocups" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ALERGIA</td>
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
            $('#profocups').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection