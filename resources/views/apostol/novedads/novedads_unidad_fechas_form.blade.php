@extends('apostol.plantilla')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/varios.css') }}"> {{-- asset css PARA GENERACIÓN DE HTML --}}
@endsection

@section('content_header')
<h3 id="titulo">PARTE DEL (DE LA) {{$unidad->abrev}}</h3>
<h3 id="titulo">POR RANGO DE FECHAS</h3>
@endsection

@section('content')
{!! Form::open(['route' => 'unidads.rango', 'method' => 'post']) !!}
    @csrf
    <div class="form-group" id="destino_id" style="display: none">
        {{ Form::label('unidad_id', 'UNIDAD_ID') }}
        {{ Form::text('unidad_id', $unidad->id, ['class' => 'form-control', 'required', 'readonly']) }}
        @error('unidad_id')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('desde', 'DESDE') }}
        {{ Form::date('desde', null, ['class' => 'form-control', 'required']) }}
        @error('desde')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('hasta', 'HASTA') }}
        {{ Form::date('hasta', null, ['class' => 'form-control', 'required']) }}
        @error('hasta')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <a href="{{route('unidads.index')}}" class="btn btn-secondary">CANCELAR</a>
    {{ Form::submit('BUSCAR', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}
@endsection