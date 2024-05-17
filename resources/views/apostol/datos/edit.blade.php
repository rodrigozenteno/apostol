@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3><b>FORMULARIO PARA EDICIÓN DE DATOS COMPLEMENTARIOS</b></h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['datos.update', $dato_complementario], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('direccion', 'DIRECCIÓN ACTUAL') }}
            {{ Form::text('direccion', $dato_complementario->direccion, ['placeholder' => 'INGRESE DIRECCIÓN DOMICILIO', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('direccion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('cel', 'NÚMERO DE CELULAR') }}
            {{ Form::number('cel', $dato_complementario->cel, ['placeholder' => '72001957', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()', 'min' =>'1']) }}
            @error('cel')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('contacto', 'CONTACTO DE EMERGENCIA') }}
            {{ Form::text('contacto', $dato_complementario->contacto, ['placeholder' => 'INGRESE NOMBRE DEL CONTACTO DE EMERGENCIA', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('contacto')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('cel_contacto', 'NÚMERO DE CELULAR') }}
            {{ Form::number('cel_contacto', $dato_complementario->cel_contacto, ['placeholder' => '72001957', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()', 'min' =>'1']) }}
            @error('cel_contacto')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('datos.datos_complementarios', $dato_complementario->user_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection