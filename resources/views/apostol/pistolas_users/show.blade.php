@extends('apostol.plantilla')

@section('content_header')
<h3>Registro de pistola del {{grado_nombre_completo($user_id)}}</h3>
@endsection

@section('content')
        <div class="form-group">
            {{ Form::label('industria_id', 'INDUSTRIA') }}
            {{ Form::text('industria_id', $pistola_user->modelo->marca->industria->industria, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('marca_id', 'MARCA') }}
            {{ Form::text('marca_id', $pistola_user->modelo->marca->marca, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('modelo_id', 'MODELO') }}
            {{ Form::text('modelo_id', $pistola_user->modelo->modelo, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('serie', 'NÚMERO DE PISTOLA') }}
            {{ Form::text('serie', $pistola_user->serie, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('cargador', 'CANTIDAD DE CARGADORES') }}
            {{ Form::text('cargador', $pistola_user->cargador, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('situacion_id', 'SITUACIÓN') }}
            {{ Form::text('situacion_id', $pistola_user->situacion->situacion, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('novedades', 'NOVEDADES') }}
            {{ Form::text('novedades', $pistola_user->novedades, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('dotacion', 'FECHA DE DOTACIÓN') }}
            {{ Form::text('dotacion', $pistola_user->dotacion, ['class' => 'form-control', 'readonly']) }}
        </div>
        <a href="{{route('datos.datos_complementarios', $pistola_user->user_id)}}" class="btn btn-secondary">ATRÁS</a>
@endsection