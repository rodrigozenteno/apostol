@extends('apostol.plantilla')

@section('content_header')
<h3>
    @if($armamento_user->tipo == 1)
        DATOS DE LA PISTOLA DEL {{grado_nombre_completo($user_id)}}
    @endif
    @if($armamento_user->tipo == 2)
        DATOS DEL CUCHILLO BAYONETA DEL {{grado_nombre_completo($user_id)}}
    @endif
</h3>
@endsection

@section('content')
        <div class="form-group">
            {{ Form::label('industria_id', 'INDUSTRIA') }}
            {{ Form::text('industria_id', $armamento_user->modelo->marca->industria->industria, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('marca_id', 'MARCA') }}
            {{ Form::text('marca_id', $armamento_user->modelo->marca->marca, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('modelo_id', 'MODELO') }}
            {{ Form::text('modelo_id', $armamento_user->modelo->modelo, ['class' => 'form-control', 'readonly']) }}
        </div>
        @if($armamento_user->tipo == 1)
            <div class="form-group">
                {{ Form::label('calibre', 'CALIBRE') }}
                {{ Form::text('calibre', $armamento_user->modelo->calibre, ['class' => 'form-control', 'readonly']) }}
            </div>
        @endif
        <div class="form-group">
            @if($armamento_user->tipo == 1)
                {{ Form::label('serie', 'NÚMERO DE PISTOLA') }}
            @endif
            @if($armamento_user->tipo == 2)
                {{ Form::label('serie', 'NÚMERO DE CUCHILLO BAYONETA') }}
            @endif
            {{ Form::text('serie', $armamento_user->serie, ['class' => 'form-control', 'readonly']) }}
        </div>
        @if($armamento_user->tipo == 1)
            <div class="form-group">
                {{ Form::label('cargador', 'CANTIDAD DE CARGADORES') }}
                {{ Form::number('cargador', $armamento_user->cargador, ['class' => 'form-control', 'readonly']) }}
            </div>
        @endif
        @if($armamento_user->tipo == 2)
            <div class="form-group">
                {{ Form::label('uso', 'USO') }}
                {{ Form::text('uso', $armamento_user->uso, ['class' => 'form-control', 'readonly']) }}
                @error('uso')
                <small>* {{$message}}</small>
                <br>
                @enderror
            </div>
        @endif
        @if($armamento_user->tipo == 2)
            <div class="form-group">
                {{ Form::label('accesorios', 'ACCESORIOS') }}
                {{ Form::text('accesorios', $armamento_user->accesorios, ['class' => 'form-control', 'readonly']) }}
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('situacion_id', 'SITUACIÓN') }}
            {{ Form::text('situacion_id', $armamento_user->situacion->situacion, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('novedades', 'NOVEDADES') }}
            {{ Form::text('novedades', $armamento_user->novedades, ['class' => 'form-control', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('dotacion', 'FECHA DE DOTACIÓN') }}
            {{ Form::text('dotacion', $armamento_user->dotacion, ['class' => 'form-control', 'readonly']) }}
        </div>
        <a href="{{route('datos.datos_complementarios', $armamento_user->user_id)}}" class="btn btn-secondary">ATRÁS</a>
@endsection