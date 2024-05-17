@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de tipos de Unidad</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['tipos.update', $tipo], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('tipo', 'TIPO') }}
            {{ Form::text('tipo', $tipo->tipo, ['placeholder' => 'FRONTERA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('tipo')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('tipos.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection