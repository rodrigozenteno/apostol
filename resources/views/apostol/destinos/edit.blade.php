@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>FORMULARIO PARA EDICIÓN DE DESTINO PARA EL {{ grado_nombre_completo($destino->user_id) }}</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['destinos.update', $destino], 'method' => 'put']) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('user_id', 'USUARIO') }}
            {{ Form::text('user_id', $destino->user_id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('user_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="unidad_id">
            {{ Form::label('unidad_id', 'SELECCIONE UNIDAD') }}
            {{ Form::select('unidad_id', $unidads, $destino->unidad_id, ['class' => 'form-control select-unidad', 'multiple', 'required']) }}
            @error('unidad_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('datos.datos_complementarios', $destino->user_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
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
            placeholder_text_multiple: "CLICK PARA SELECCIONAR UNIDAD"
        });
    </script>
@endsection