@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de documentos</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['documentos.update', $documento], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('documento', 'ALERGIA') }}
            {{ Form::text('documento', $documento->documento, ['placeholder' => 'FOTOCOPIA DE CERTIFICADO DE MATRIMONIO', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('documento')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('documentos.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection