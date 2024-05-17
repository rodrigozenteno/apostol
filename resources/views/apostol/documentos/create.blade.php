@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de documentos</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'documentos.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('documento', 'DOCUMENTO') }}
            {{ Form::text('documento', null, ['placeholder' => 'FOTOCOPIA DE CARNET DE IDENTIDAD', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('documento')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('documentos.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection