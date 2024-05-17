@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de armas</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'armas.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('arma', 'DIPLOMADO') }}
            {{ Form::text('arma', null, ['placeholder' => 'INFANTERÍA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('arma')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('abreviacion', 'ABREVIACIÓN') }}
            {{ Form::text('abreviacion', null, ['placeholder' => 'INF.', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('abreviacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('armas.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection