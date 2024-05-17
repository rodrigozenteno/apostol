@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de situacions</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['situacions.update', $situacion], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('situacion', 'SITUACIÓN') }}
            {{ Form::text('situacion', $situacion->situacion, ['placeholder' => 'PÉRDIDA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('situacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('situacions.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection