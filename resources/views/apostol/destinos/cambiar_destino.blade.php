@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>FORMULARIO DE CAMBIO DE DESTINO PARA EL {{ grado_nombre_completo($destino->user_id) }}</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'destinos.store_cambio', 'method' => 'post']) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('destino_id', 'DESTINO ID') }}
            {{ Form::text('destino_id', $destino->id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('destino_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('d_actual', 'DESTINO ACTUAL') }}
            {{ Form::text('d_actual', $destino->unidad->unidad, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group" id="unidad_id">
            {{ Form::label('unidad_id', 'SELECCIONE NUEVA UNIDAD') }}
            {{ Form::select('unidad_id', $unidads, null, ['class' => 'form-control select-unidad', 'multiple', 'required']) }}
            @error('unidad_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('datos.datos_complementarios', $destino->user_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-unidad").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR NUEVA UNIDAD"
        });
    </script>
@endsection