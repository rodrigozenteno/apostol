@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>FORMULARIO DE ELIMINACIÓN DE NOVEDAD PARA EL {{ grado_nombre_completo($destino_novedad->destino->user_id) }}</h3>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    <!-- {!! Form::open(['route' => ['destinos_novedads.destroy', $destino_novedad], 'method' => 'delete']) !!} -->
    {!! Form::open(['route' => ['destinos_novedads.destroy'], 'method' => 'delete']) !!}
        @csrf
        <div class="form-group" id="destino_id" style="display: none">
            {{ Form::label('destino_novedad_id', 'DESTINO_ID') }}
            {{ Form::text('destino_novedad_id', $destino_novedad->id, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group" id="destino_id" style="display: none">
            {{ Form::label('unidad_id', 'UNIDAD_ID') }}
            {{ Form::text('unidad_id', $destino_novedad->destino->unidad_id, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group" id="novedad_id">
            {{ Form::label('novedad_id', 'NOVEDAD') }}
            {{ Form::text('novedad_id', $destino_novedad->novedad->novedad, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('desde', 'DESDE') }}
            {{ Form::date('desde', $destino_novedad->desde, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('hasta', 'HASTA') }}
            {{ Form::date('hasta', $destino_novedad->hasta, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('obs', 'OBSERVACIONES') }}
            {{ Form::textarea('obs', $destino_novedad->obs, ['class' => 'form-control', 'readonly']) }}
        </div>
        <a href="{{route('destinos.index_destinados', $destino_novedad->destino->unidad_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('ELIMINAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection