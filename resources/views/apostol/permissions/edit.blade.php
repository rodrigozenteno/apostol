@extends('apostol.plantilla')

@section('content_header')
<h3>FORMULARIO PARA LA EDICIÓN DE PERMISOS</h3>
@endsection

@section('content')
    {!! Form::model($permission, ['route' => ['permissions.update', $permission], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('name', 'PERMISO') }}
            {{ Form::text('name', null, ['placeholder' => 'VER ALERGIAS', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('name')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('permissions.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection