@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de ubicaciones</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['ubicacions.update', $ubicacion], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('ubicacion', 'UBICACIÓN') }}
            {{ Form::text('ubicacion', $ubicacion->ubicacion, ['placeholder' => 'FRONTERA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('ubicacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('ubicacions.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection