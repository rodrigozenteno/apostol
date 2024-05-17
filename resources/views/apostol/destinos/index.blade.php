@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>RELACIÓN NOMINAL DEL PERSONAL DE CUADROS DESTINADO EN EL (LA)</h1>
    <h1>{{ $unidad->unidad }}</h1>
@endsection
@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    @php
        $destinados = destinados($unidad->id);
    @endphp
    @if (count($destinados) > 0)
        @php
            $i=0;
        @endphp
        <table id="destinados" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>NOMBRE COMPLETO</td>
                    <td>DESDE</td>
                    <td>CARGO</td>
                    <td>NOVEDAD</td>
                    <td>OPCIONES</td>
                </tr>
            </thead>
            @foreach ($destinados as $destinado)
                @php
                    $i++;
                @endphp
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ grado_nombre_completo($destinado) }}</td>
                    <td>{{ destino_desde($destinado) }}</td>
                    <td>CARGO</td>
                    
                    @if (!verificar_novedad($destinado))
                        <td>---</td>
                        <td>
                            <a href="{{route('destinos_novedads.create', $destinado)}}" class="btn btn-secondary" title="REGISTRAR NOVEDAD"><i class="fas fa-solid fa-list"></i></a>
                            <a href="#" class="btn btn-secondary" title="VER VACACIONES"><i class="fas fa-solid fa-plane-departure"></i></a>
                        </td>
                    @else
                        <td>{{ver_novedad($destinado)}}</td>
                        <td>
                            <a href="{{route('destinos_novedads.show', verificar_novedad($destinado))}}" class="btn btn-secondary" title="VER NOVEDAD"><i class="fas fa-fsolid fa-eye"></i></a>
                            <a href="{{route('destinos_novedads.eliminar', verificar_novedad($destinado))}}" class="btn btn-secondary" title="EDITAR NOVEDAD"><i class="fas fa-solid fa-trash"></i></a>
                            <a href="#" class="btn btn-secondary" title="VER VACACIONES"><i class="fas fa-solid fa-plane-departure"></i></a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @else
        <table id="destinados" class="stripe" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>NOMBRE COMPLETO</td>
                    <td>DESDE</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            <tr>
                <td colspan="4" align="center">SIN REGISTRO</td>
            </tr>
        </table>
    @endif
    <br>
    @if(count($uu_dd) > 0)
        <h4>UNIDADES DEPENDIENTES DEL (DE LA) {{ $unidad->unidad }}</h4>
        @foreach($uu_dd as $u_d)
            @php
                $destinados = destinados($u_d->id);
            @endphp
            <h5>RELACIÓN NOMINAL DEL PERSONAL DE CUADROS DESTINADO EN EL (LA)</h5>
            <h5>{{ $u_d->unidad }}</h5>
            @if (count($destinados) > 0)
                @php
                    $i=0;
                @endphp
                <table id="destinados" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <td>N°</td>
                            <td>NOMBRE COMPLETO</td>
                            <td>DESDE</td>
                            <td>CARGO</td>
                            <td>NOVEDAD</td>
                            <td>OPCIONES</td>
                        </tr>
                    </thead>
                    @foreach ($destinados as $destinado)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td>{{ $i}}</td>
                            <td>{{ grado_nombre_completo($destinado) }}</td>
                            <td>{{ destino_desde($destinado) }}</td>
                            <td>CARGO</td>
                            
                            @if (!verificar_novedad($destinado))
                                <td>---</td>
                                <td>
                                    <a href="{{route('destinos_novedads.create', $destinado)}}" class="btn btn-secondary" title="REGISTRAR NOVEDAD"><i class="fas fa-solid fa-list"></i></a>
                                    <a href="#" class="btn btn-secondary" title="VER VACACIONES"><i class="fas fa-solid fa-plane-departure"></i></a>
                                </td>
                            @else
                                <td>{{ver_novedad($destinado)}}</td>
                                <td>
                                    <a href="{{route('destinos_novedads.show', verificar_novedad($destinado))}}" class="btn btn-secondary" title="VER NOVEDAD"><i class="fas fa-fsolid fa-eye"></i></a>
                                    <a href="{{route('destinos_novedads.edit', verificar_novedad($destinado))}}" class="btn btn-secondary" title="EDITAR NOVEDAD"><i class="fas fa-solid fa-pen"></i></a>
                                    <a href="#" class="btn btn-secondary" title="VER VACACIONES"><i class="fas fa-solid fa-plane-departure"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            @else
                <table id="destinados" class="stripe" style="width:100%">
                    <thead>
                        <tr>
                            <td>N°</td>
                            <td>NOMBRE COMPLETO</td>
                            <td>DESDE</td>
                            <td>ACCIONES</td>
                        </tr>
                    </thead>
                    <tr>
                        <td colspan="4" align="center">SIN REGISTRO</td>
                    </tr>
                </table>
            @endif
            <br>
        @endforeach
        @endif
    <a href="{{route('unidads.index')}}" class="btn btn-secondary">RETORNAR</a>
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#destinados').DataTable({
                "paging": false,
                "info" : false,
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection