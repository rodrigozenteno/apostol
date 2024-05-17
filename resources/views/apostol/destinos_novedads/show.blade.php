@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>NOVEDAD DEL {{ grado_nombre_completo($destino_novedad->destino->user_id) }}</h3>
@endsection

@section('content')
        <div class="form-group" id="novedad_id">
            {{ Form::label('novedad_id', 'SELECCIONE NOVEDAD') }}
            {{ Form::text('novedad_id', $destino_novedad->novedad->novedad, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('desde', 'DESDE') }}
            {{ Form::text('desde', $destino_novedad->desde, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('hasta', 'HASTA') }}
            {{ Form::text('hasta', $destino_novedad->hasta, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('obs', 'OBSERVACIONES') }}
            {{ Form::textarea('obs', $destino_novedad->obs, ['class' => 'form-control', 'readonly']) }}
        </div>
        <a href="{{route('destinos.index_destinados', $destino_novedad->destino->unidad_id)}}" class="btn btn-secondary">RETORNAR</a>
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-novedad").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR NOVEDAD"
        });
    </script>
@endsection