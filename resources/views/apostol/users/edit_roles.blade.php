@extends('apostol.plantilla')

@section('content_header')
<h3>FORMULARIO PARA ASIGNACIÓN DE ROLES A LOS USUARIOS</h3>
@endsection

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{session('info')}}
        </div>
    @endif
    {!! Form::model($user, ['route' => ['users.update_roles', $user], 'method' => 'put']) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('user_id', 'USUARIO') }}
            {{ Form::text('user_id', $user->id, ['class' => 'form-control', 'required', 'readonly']) }}
        </div>
        <h4>SELECCIONE LOS ROLES PARA ASIGNAR AL {{grado_nombre_completo($user->id)}}</h4>
        @foreach ($roles as $role)
            <div>
                <label>
                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                    {{$role->name}}
                </label>
            </div>
        @endforeach
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection