@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>FORMULARIO DE REGISTRO DE NOVEDAD PARA EL {{ grado_nombre_completo($destino->user_id) }}</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'destinos_novedads.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group" id="destino_id" style="display: none">
            {{ Form::label('destino_id', 'DESTINO_ID') }}
            {{ Form::text('destino_id', $destino->id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('destino_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="destino_id" style="display: none">
            {{ Form::label('unidad_id', 'UNIDAD_ID') }}
            {{ Form::text('unidad_id', $destino->unidad_id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('unidad_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="novedad_id">
            {{ Form::label('novedad_id', 'SELECCIONE NOVEDAD') }}
            {{ Form::select('novedad_id', $novedads, null, ['class' => 'form-control select-novedad', 'multiple', 'required']) }}
            @error('novedad_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('desde', 'DESDE') }}
            {{ Form::date('desde', $desde, ['class' => 'form-control', 'required', 'min' => $desde]) }}
            @error('desde')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('hasta', 'HASTA') }}
            {{ Form::date('hasta', null, ['class' => 'form-control']) }}
            @error('hasta')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('obs', 'OBSERVACIONES') }}
            {{ Form::textarea('obs', null, ['placeholder' => 'DETALLES DE LA NOVEDAD, SI FUERAN NECESARIOS', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('obs')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('destinos.index_destinados', $destino->unidad_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
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