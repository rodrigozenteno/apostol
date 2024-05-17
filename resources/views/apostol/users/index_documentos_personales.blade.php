@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>LISTA DE DOCUMENTOS DEL {{$grado_nombre_completo}}</h1>
@endsection

@section('content')
    @if (count($documentos))
        @php
            $i=0;
        @endphp
        <table id="documentos" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>DOCUMENTO</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($documentos as $documento)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $documento->documento }}</td>
                    @if(verif_doc($documento->id,$id) > 0)
                        <td>
                            <a href="#" class="btn btn-secondary" title="VALIDAR"><i class="fas fa-solid fa-check"></i></a>
                    @else
                        <td>
                            <a href="{{route('users.insert_doc_pers', [$id, $documento->id])}}" class="btn btn-secondary" title="INSERTAR"><i class="fas fa-solid fa-arrow-up"></i></a>
                            {{-- {!! Form::open(['route' => ['users.destroy', $documento->id], 'method' => 'delete', 'class' => 'formEliminar']) !!}
                                @csrf
                                <button type="submit" class="btn btn-secondary">ELIMINAR</button>
                            {!! Form::close() !!} --}}
                    @endif
                        <a href="#" class="btn btn-secondary" title="EDITAR"><i class="fas fa-fsolid fa-pen"></i></a>
                        <a href="#" class="btn btn-secondary" title="ELIMINAR">X</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <table id="documentos" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>DOCUMENTO</td>
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
            $('#documentos').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection