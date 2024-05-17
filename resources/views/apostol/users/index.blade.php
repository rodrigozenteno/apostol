@extends('apostol.plantilla')


@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"> {{-- PARA QUE LA COLUMNA OPCIONES NO TENGA SALTO DE LÍNEA --}}
@endsection
@section('title', 'USUARIOS')
@section('content_header')
    @if ($band == 1)
        <h1><b>RELACIÓN NOMINAL DEL PERSONAL DE ARMAS</b></h1>
    @endif
    @if ($band == 2)
        <h1><b>RELACIÓN NOMINAL DEL PERSONAL DE SERVICIOS</b></h1>
    @endif
    @if ($band == 3)
        <h1><b>RELACIÓN NOMINAL DEL PERSONAL DE EMPLEADOS CIVILES</b></h1>
    @endif
    @if ($band == 4)
        <h1><b>RELACIÓN NOMINAL DEL PERSONAL POR ANTIGUEDAD</b></h1>
    @endif
@endsection

@section('content')
    @if ($band == 1)
        <a href="{{route('users.create', 1)}}" class="btn btn-secondary mb-4">REGISTRAR PERSONAL</a>
    @endif
    @if ($band == 2)
        <a href="{{route('users.create', 2)}}" class="btn btn-secondary mb-4">REGISTRAR PERSONAL</a>
    @endif
    @if ($band == 3)
        <a href="{{route('users.create', 3)}}" class="btn btn-secondary mb-4">REGISTRAR PERSONAL</a>
    @endif
    @php
        $i=0;
    @endphp
    <table id="users" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <td>N°</td>
                <td>C.I.</td>
                <td>GRADO Y NOMBRE COMPLETO</td>
                <td>DESTINO</td>
                <td>OPCIONES</td>
            </tr>
        </thead>
        @if (count($users))
            @foreach ($users as $user)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ci($user)}}</td>
                    <td>{{grado_nombre_completo($user, 'index')}}</td>
                    <td>{{destino_user($user)}}</td>
                    <td>
                        <a href="{{route('documentos_users.index', $user)}}" class="btn btn-secondary" title="DOCUMENTACIÓN"><i class="fas fa-regular fa-folder"></i></a>
                        <a href="{{route('datos.datos_complementarios', $user)}}" class="btn btn-secondary" title="DATOS COMPLEMENTARIOS"><i class="fas fa-fsolid fa-eye"></i></a>
                        <a href="{{route('pdfs.pdf_user', $user)}}" class="btn btn-secondary" title="DESCARGAR"><i class="fas fa-solid fa-file-pdf"></i></a>
                        <a href="{{route('users.asignar_roles', $user)}}" class="btn btn-secondary" title="ASIGNAR ROLES"><i class="fas fa-solid fa-key"></i></a>
                        <a href="#" class="btn btn-secondary" title="ELIMINAR"><i class="fas fa-solid fa-user-minus"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" align="center">SIN REGISTRO</td>
            </tr>
        @endif
    </table>
@endsection
{{-- @section('js_bootstrap')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection --}}
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection