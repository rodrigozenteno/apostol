@extends('apostol.plantilla')

@section('content_header')
<h3>Datos de Unidad</h3>
@endsection

@section('content')
    <div class="form-group">
        {{ Form::label('unidad', 'UNIDAD') }}
        {{ Form::text('unidad', $unidad->unidad, ['class' => 'form-control', 'readonly']) }}
    </div>
    <div class="form-group">
        {{ Form::label('abrev', 'ABREVIACIÓN') }}
        {{ Form::text('abrev', $unidad->abrev, ['class' => 'form-control', 'readonly']) }}
    </div>
    <div class="form-group">
        {{ Form::label('unidad_id', 'UNIDAD SUPERIOR') }}
        @if ($unidad->superior == null)
            {{ Form::text('unidad_id', null, ['class' => 'form-control', 'readonly']) }}
        @else
            {{ Form::text('unidad_id', $unidad->superior->unidad, ['class' => 'form-control', 'readonly']) }}
        @endif
        
    </div>
    <div class="form-group">
        {{ Form::label('abrev', 'LUGAR DE UBICACIÓN') }}
        {{ Form::text('abrev', $unidad->municipio->municipio.'-'.$unidad->municipio->provincia->provincia.'-'.$unidad->municipio->provincia->departamento->departamento, ['class' => 'form-control', 'readonly']) }}
    </div>
    <div class="form-group">
        {{ Form::label('ubicacion', 'TIPO DE UBICACIÓN') }}
        {{ Form::text('ubicacion', $unidad->ubicacion->ubicacion, ['class' => 'form-control', 'readonly']) }}
    </div>
    <div class="form-group">
        {{ Form::label('tipo', 'TIPO DE UNIDAD') }}
        {{ Form::text('tipo', $unidad->tipo->tipo, ['class' => 'form-control', 'readonly']) }}
    </div>
    <a href="{{route('unidads.index')}}" class="btn btn-secondary">RETORNAR</a>
@endsection