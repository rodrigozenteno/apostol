@extends('apostol.plantilla')

@section('content_header')
    <h3>FORMULARIO PARA LA EDICIÓN DE ROLES</h3>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put']) !!}
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
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection