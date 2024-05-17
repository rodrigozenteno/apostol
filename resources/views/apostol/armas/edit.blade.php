@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de armas</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['armas.update', $arma], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('arma', 'DIPLOMADO') }}
            {{ Form::text('arma', $arma->arma, ['placeholder' => 'ARTILLERÍA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('arma')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('abreviacion', 'ABREVIACIÓN') }}
            {{ Form::text('abreviacion', $arma->abreviacion, ['placeholder' => 'ART.', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('abreviacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('armas.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection