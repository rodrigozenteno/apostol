@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"> {{-- PARA QUE LA COLUMNA OPCIONES NO TENGA SALTO DE LÍNEA --}}
@endsection

@section('content_header')
    <h1>LISTA DE ROLES</h1>
@endsection

@section('content')
    <a href="{{route('roles.create')}}" class="btn btn-secondary mb-4">REGISTRAR ROL</a>
    @if (count($roles))
        @php
            $i=0;
        @endphp
        <table id="roles" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ROL</td>
                    <td colspan="2">OPCIONES</td>
                </tr>
            </thead>
            @foreach ($roles as $role)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $role->name }}</td>
                    <td id="celda_edit">
                        <a href="{{route('roles.edit', $role)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a>
                    </td>
                    <td>
                        <form action="{{'roles.destroy', $role->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">ELIMINAR</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="roles" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>ROL</td>
                    <td>OPCIONES</td>
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
            $('#roles').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection