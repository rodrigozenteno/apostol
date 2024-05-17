@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de diplomados</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['diplomados.update', $diplomado], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('diplomado', 'DIPLOMADO') }}
            {{ Form::text('diplomado', $diplomado->diplomado, ['placeholder' => 'DIPLOMADO DE INGENIERÍA MILITAR', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('diplomado')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('abreviacion', 'ABREVIACIÓN') }}
            {{ Form::text('abreviacion', $diplomado->abreviacion, ['placeholder' => 'DIM.', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('abreviacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('diplomados.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection