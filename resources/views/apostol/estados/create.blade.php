@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de estados</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'estados.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('estado', 'ESTADO') }}
            {{ Form::text('estado', null, ['placeholder' => 'SERVICIO ACTIVO', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('estado')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('estados.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection