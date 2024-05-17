@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3><b>FORMULARIO PARA EDICIÓN DE MUNICIPIO</b></h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['municipios.update', $municipio], 'method' => 'put']) !!}
        @csrf
        <div class="form-group" id="departamento_id">
            {{ Form::label('departamento_id', 'DEPARTAMENTO') }}
            {{ Form::select('departamento_id', $departamentos, $municipio->provincia->departamento->id, ['class' => 'form-control', 'placeholder' => 'SELECCIONE DEPARTAMENTO','required', 'id' => 'select_departamento']) }}
            @error('departamento_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="provincia_id">
            {{ Form::label('provincia_id', 'PROVINCIA') }}
            <select name="provincia_id" id="select_provincia" class="form-control">
                <option value="{{$municipio->provincia->id}}">{{ $municipio->provincia->provincia }}</option>
            </select>
            @error('provincia_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('municipio', 'MUNICIPIO') }}
            {{ Form::text('municipio', $municipio->municipio, ['placeholder' => 'RAFAEL BUSTILLOS', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('municipio')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('municipios.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_script')
    <script src="{{ asset('/js/municipios/create.js') }}"></script>
@endsection