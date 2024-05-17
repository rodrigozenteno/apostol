@extends('apostol.plantilla')

@section('content_header')
<h3>FORMULARIO PARA REGISTRO DE ROLES</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'roles.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('name', 'ROL') }}
            {{ Form::text('name', null, ['placeholder' => 'ADMINISTRADOR', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('name')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>

        <h2>RELACIÓN NOMINAL DE PERMISOS</h2>
        @foreach ($permissions as $permission)
            <div>
                <label>
                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                    {{$permission->name}}
                </label>
            </div>
        @endforeach
        <a href="{{route('roles.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection