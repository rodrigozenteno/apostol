@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de novedades</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['novedads.update', $novedad], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('novedad', 'NOVEDAD') }}
            {{ Form::text('novedad', $novedad->novedad, ['placeholder' => 'VACACIÓN PROGRAMADA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('novedad')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('novedads.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection