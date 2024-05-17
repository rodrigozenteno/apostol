@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>
    @if($armamento_user->tipo == 1)
        FORMULARIO PARA EL EDICIÓN DEL REGISTO DE PISTOLA DEL {{grado_nombre_completo($armamento_user->user_id)}}
    @endif
    @if($armamento_user->tipo == 2)
        FORMULARIO PARA EL EDICIÓN DEL REGISTO DE CUCHILLO BAYONETA DEL {{grado_nombre_completo($armamento_user->user_id)}}
    @endif
</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['armamentos_users.update', $armamento_user], 'method' => 'put']) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('user_id', 'USUARIO') }}
            {{ Form::text('user_id', $armamento_user->user_id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('user_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('tipo', 'TIPO') }}
            {{ Form::text('tipo', $armamento_user->tipo, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('tipo')
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
            @if($armamento_user->tipo == 1)
                {{ Form::label('serie', 'NÚMERO DE PISTOLA') }}
            @endif
            @if($armamento_user->tipo == 2)
                {{ Form::label('serie', 'NÚMERO DE CUCHILLO BAYONETA') }}
            @endif
            {{ Form::text('serie', $armamento_user->serie, ['placeholder' => 'TVB70586', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('serie')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        @if($armamento_user->tipo == 1)
            <div class="form-group">
                {{ Form::label('cargador', 'CANTIDAD DE CARGADORES') }}
                {{ Form::number('cargador', null, ['placeholder' => '1', 'class' => 'form-control', 'required', 'min' =>'1', 'max' =>'300']) }}
                @error('cargador')
                <small>* {{$message}}</small>
                <br>
                @enderror
            </div>
        @endif
        @if($armamento_user->tipo == 2)
            <div class="form-group">
                {{ Form::label('uso', 'USO') }}
                {{ Form::text('uso', $armamento_user->uso, ['placeholder' => 'CUCHILLO DE ASALTO', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
                @error('uso')
                <small>* {{$message}}</small>
                <br>
                @enderror
            </div>
        @endif
        @if($armamento_user->tipo == 2)
            <div class="form-group">
                {{ Form::label('accesorios', 'ACCESORIOS') }}
                {{ Form::text('accesorios', $armamento_user->accesorios, ['placeholder' => 'SIN ACCESORIOS', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
                @error('accesorios')
                <small>* {{$message}}</small>
                <br>
                @enderror
            </div>
        @endif
        <div class="form-group">
            {{ Form::label('situacion_id', 'SITUACIÓN DEL ARMAMENTO') }}
            {{ Form::select('situacion_id', $situacions, $armamento_user->situacion_id, ['class' => 'form-control', 'placeholder' => 'CLICK PARA SELECCIONAR SITUACIÓN DEL ARMAMENTO','required', 'id' => 'select_departamento']) }}
            @error('situacion_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('novedades', 'NOVEDADES') }}
            {{ Form::text('novedades', $armamento_user->novedades, ['placeholder' => 'AGUJA PERCUTORA EN MAL ESTADO, ETC.', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('novedades')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('dotacion', 'FECHA DE DOTACIÓN') }}
            {{ Form::number('dotacion', $armamento_user->dotacion, ['placeholder' => '1900', 'class' => 'form-control', 'required', 'min' =>'1900', 'max' =>$anio]) }}
            @error('dotacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('datos.datos_complementarios', $armamento_user->user_id)}}" class="btn btn-secondary">ATRÁS</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_script')
    <script src="{{ asset('js/marcas/create.js') }}"></script>
@endsection

@section('js_script2')
    <script src="{{ asset('js/modelos/create.js') }}"></script>
@endsection