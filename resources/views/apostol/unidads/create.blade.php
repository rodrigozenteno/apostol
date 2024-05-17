@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para registro de Unidades</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'unidads.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('unidad', 'UNIDAD') }}
            {{ Form::text('unidad', null, ['placeholder' => 'GRUPO DE CABALLERÍA AÉREA DEL EJÉRCITO "GRAL. APÓSTOL SANTIAGO"', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('unidad')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('abrev', 'ABREVIACIÓN') }}
            {{ Form::text('abrev', null, ['placeholder' => 'GCAE-1 "APÓSTOL SANTIAGO"', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('abrev')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('unidad_id', 'UNIDAD SUPERIOR') }}
            {{ Form::select('unidad_id', $unidads, null, ['class' => 'form-control', 'placeholder' => 'CLICK PARA SELECCIONAR UNIDAD SUPERIOR']) }}
            @error('unidad_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('l_nac', 'LUGAR DE UBICACIÓN') }}
            {{ Form::select('departamento_id', $departamentos, null, ['class' => 'form-control', 'placeholder' => 'CLICK PARA SELECCIONAR DEPARTAMENTO','required', 'id' => 'select_departamento']) }}
            @error('departamento_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="provincia_id">
            <select name="provincia_id" id="select_provincia" class="form-control" required>
                <option value="">CLICK PARA SELECCIONAR PROVINCIA</option>
            </select>
            @error('provincia_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="municipio_id">
            <select name="municipio_id" id="select_municipio" class="form-control" required>
                <option value="">CLICK PARA SELECCIONAR MUNICIPIO</option>
            </select>
            @error('municipio_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="ubicacion_id">
            {{ Form::label('ubicacion_id', 'TIPO DE UBICACIÓN') }}
            {{ Form::select('ubicacion_id', $ubicacions, null, ['class' => 'form-control select-ubicacion', 'multiple', 'required']) }}
            @error('ubicacion_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="tipo_id">
            {{ Form::label('tipo_id', 'TIPO DE UNIDAD') }}
            {{ Form::select('tipo_id', $tipos, null, ['class' => 'form-control select-tipo', 'multiple', 'required']) }}
            @error('tipo_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('unidads.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-municipio").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR MUNICIPIO"
        });
        $(".select-ubicacion").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR UBICACIÓN"
        });
        $(".select-tipo").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR TIPO DE UNIDAD"
        });
    </script>
@endsection
@section('js_script')
    <script src="{{ asset('js/municipios/create.js') }}"></script>
@endsection

@section('js_script2')
    <script src="{{ asset('js/users/create.js') }}"></script>
@endsection