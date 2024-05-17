@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de escalafones</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['escalafons.update', $escalafon], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('escalafon', 'ESCALAFÓN') }}
            {{ Form::text('escalafon', $escalafon->escalafon, ['placeholder' => 'EE. CC.', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('escalafon')
            <small>*{{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('escalafons.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection