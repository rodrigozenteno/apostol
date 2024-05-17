@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para registro de modelos</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'modelos.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('modelo', 'MODELO') }}
            {{ Form::text('modelo', null, ['placeholder' => '24/7', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('modelo')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('calibre', 'CALIBRE') }}
            {{ Form::text('calibre', null, ['placeholder' => '9 mm', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('calibre')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="marca_id">
            {{ Form::label('marca_id', 'MARCA') }}
            {{ Form::select('marca_id', $marcas, null, ['class' => 'form-control select-marca', 'multiple', 'required']) }}
            @error('marca_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('modelos.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-marca").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR MARCA"
        });
    </script>
@endsection