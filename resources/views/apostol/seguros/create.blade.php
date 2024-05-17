@extends('apostol.plantilla')

@section('content_header')
        <h3>Formulario para registro de seguros</h3>
    @endsection

@section('content')
    {!! Form::open(['route' => 'seguros.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('seguro', 'SEGURO') }}
            {{ Form::text('seguro', null, ['placeholder' => 'CORPORACIÓN DEL SEGURO SOCIAL MILITAR', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('seguro')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('seguros.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection