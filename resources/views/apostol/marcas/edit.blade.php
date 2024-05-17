@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para edición de marcas</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['marcas.update', $marca], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('marca', 'MARCA') }}
            {{ Form::text('marca', $marca->marca, ['placeholder' => 'SMITH & WESSON', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('marca')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="industria_id">
            {{ Form::label('industria_id', 'INDUSTRIA') }}
            {{ Form::select('industria_id', $industrias, $marca->industria->id, ['class' => 'form-control select-industria', 'multiple', 'required']) }}
            @error('industria_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('marcas.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-industria").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR INDUSTRIA"
        });
    </script>
@endsection