@extends('apostol.plantilla')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/varios.css') }}"> {{-- asset css PARA GENERACIÓN DE HTML --}}
@endsection

@section('content_header')
<h3 id="titulo">PARTE DEL (DE LA) {{$unidad->abrev}}</h3>
<h3 id="titulo">DEL: {{$desde}} AL {{$hasta}}</h3>
@endsection

@section('content')
<h4 id="titulo">DEMOSTRACIÓN</h4>
    @foreach ($novedads as $novedad)
        @php
            $cont = 0;
        @endphp
        @foreach ($destino_novedad as $dest_nov)
            @if ($novedad->id == $dest_nov->novedad_id)
                @php
                    $cont++;
                @endphp
                @if ($cont == 1)
                    <div class="form-group" id="novedad_id">
                        {{ Form::label('novedad_id', $novedad->novedad) }}
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">GRADO Y NOMBRE COMPLETO</th>
                                <th scope="col">DESDE</th>
                                <th scope="col">HASTA</th>
                                <th scope="col">OBS.</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                            <tr>
                                <th scope="row">{{$cont}}</th>
                                <td>{{grado_nombre_completo($dest_nov->user_id)}}</td>
                                <td>{{$dest_nov->desde}}</td>
                                <td>{{$dest_nov->hasta}}</td>
                                <td>{{$dest_nov->obs}}</td>
                            </tr>
            @endif
        @endforeach
                    </tbody>
                </table>
    @endforeach
@endsection