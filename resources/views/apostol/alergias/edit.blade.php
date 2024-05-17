@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de alergias</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['alergias.update', $alergia], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('alergia', 'ALERGIA') }}
            {{ Form::text('alergia', $alergia->alergia, ['placeholder' => 'PICADURA DE ABEJA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('alergia')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('alergias.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection