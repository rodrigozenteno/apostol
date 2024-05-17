@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para edición del registro de pistola del {{grado_nombre_completo($pistola_user->user_id)}}</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['pistolas_users.update', $pistola_user], 'method' => 'put']) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('user_id', 'USUARIO') }}
            {{ Form::text('user_id', $pistola_user->user_id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('user_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="industria_id">
            {{ Form::label('industria_id', 'INDUSTRIA') }}
            {{ Form::select('industria_id', $industrias, null, ['class' => 'form-control', 'placeholder' => 'SELECCIONE INDUSTRIA','required', 'id' => 'select_industria']) }}
            @error('industria_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="marca_id">
            {{ Form::label('marca_id', 'MARCA') }}
            <select name="marca_id" id="select_marca" class="form-control" required>
                <option value="">CLICK PARA SELECCIONAR MARCA</option>
            </select>
            @error('marca_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="modelo_id">
            {{ Form::label('modelo_id', 'MODELO') }}
            <select name="modelo_id" id="select_modelo" class="form-control" required>
                <option value="">CLICK PARA SELECCIONAR MODELO</option>
            </select>
            @error('modelo_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('serie', 'NÚMERO DE PISTOLA') }}
            {{ Form::text('serie', $pistola_user->serie, ['placeholder' => 'TVB70586', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('serie')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('cargador', 'CANTIDAD DE CARGADORES') }}
            {{ Form::number('cargador', $pistola_user->cargador, ['placeholder' => '1', 'class' => 'form-control', 'required', 'min' =>'1', 'max' =>'300']) }}
            @error('cargador')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('situacion_id', 'SITUACIÓN DEL ARMAMENTO') }}
            {{ Form::select('situacion_id', $situacions, $pistola_user->situacion_id, ['class' => 'form-control', 'placeholder' => 'CLICK PARA SELECCIONAR SITUACIÓN DEL ARMAMENTO','required', 'id' => 'select_departamento']) }}
            @error('situacion_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('novedades', 'NOVEDADES') }}
            {{ Form::text('novedades', $pistola_user->novedades, ['placeholder' => 'AGUJA PERCUTORA EN MAL ESTADO, ETC.', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('novedades')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('dotacion', 'FECHA DE DOTACIÓN') }}
            {{ Form::number('dotacion', $pistola_user->dotacion, ['placeholder' => '1900', 'class' => 'form-control', 'required', 'min' =>'1900', 'max' =>$anio]) }}
            @error('dotacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('datos.datos_complementarios', $pistola_user->user_id)}}" class="btn btn-secondary">ATRÁS</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_script')
    <script src="{{ asset('js/marcas/create.js') }}"></script>
@endsection

@section('js_script2')
    <script src="{{ asset('js/modelos/create.js') }}"></script>
@endsection