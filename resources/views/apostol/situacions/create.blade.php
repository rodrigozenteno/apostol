@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de situaciones</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'situacions.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('situacion', 'SITUACIÓN') }}
            {{ Form::text('situacion', null, ['placeholder' => 'EN MATERIAL BÉLICO DE LA UNIDAD', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('situacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('situacions.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection