@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de departamentos</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'departamentos.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('departamento', 'DEPARTAMENTO') }}
            {{ Form::text('departamento', null, ['placeholder' => 'POTOSÍ', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('departamento')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('departamentos.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection