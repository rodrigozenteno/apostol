@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de tipos de Unidad</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'tipos.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('tipo', 'TIPO') }}
            {{ Form::text('tipo', null, ['placeholder' => 'CIUDAD', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('tipo')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('tipos.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection