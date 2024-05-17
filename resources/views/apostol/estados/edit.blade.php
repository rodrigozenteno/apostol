@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de estados</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['estados.update', $estado], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('estado', 'ESTADO') }}
            {{ Form::text('estado', $estado->estado, ['placeholder' => 'LETRA "A" DE DISPONIBILIDAD', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('estado')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('estados.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection