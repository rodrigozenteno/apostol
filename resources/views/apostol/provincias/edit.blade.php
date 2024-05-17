@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para edición de provincias</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['provincias.update', $provincia], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('provincia', 'PROVINCIA') }}
            {{ Form::text('provincia', $provincia->provincia, ['placeholder' => 'CORNELIO SAAVEDRA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('provincia')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="departamento_id">
            {{ Form::label('departamento_id', 'DEPARTAMENTO') }}
            {{ Form::select('departamento_id', $departamentos, $provincia->departamento->id, ['class' => 'form-control select-escalafon', 'multiple', 'required']) }}
            @error('departamento_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('provincias.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-escalafon").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR DEPARTAMENTO"
        });
    </script>
@endsection