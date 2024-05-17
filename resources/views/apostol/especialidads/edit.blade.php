@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de especialidades</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['especialidads.update', $especialidad], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('especialidad', 'ESPECIALIDAD') }}
            {{ Form::text('especialidad', $especialidad->especialidad, ['placeholder' => 'TÉCNICO A BORDO', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('especialidad')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('abreviacion', 'ABREVIACIÓN') }}
            {{ Form::text('abreviacion', $especialidad->abreviacion, ['placeholder' => 'TEC. B.', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('abreviacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('especialidads.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection