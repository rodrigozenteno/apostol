@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para registro de provincias</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'provincias.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('provincia', 'PROVINCIA') }}
            {{ Form::text('provincia', null, ['placeholder' => 'RAFAEL BUSTILLOS', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('provincia')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="departamento_id">
            {{ Form::label('departamento_id', 'DEPARTAMENTO') }}
            {{ Form::select('departamento_id', $departamentos, null, ['class' => 'form-control select-escalafon', 'multiple', 'required']) }}
            @error('departamento_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('provincias.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
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