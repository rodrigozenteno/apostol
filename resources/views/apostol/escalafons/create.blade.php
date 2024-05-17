@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de escalafones</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'escalafons.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('escalafon', 'ESCALAFÓN') }}
            {{ Form::text('escalafon', null, ['placeholder' => 'ARMAS', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('escalafon')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('escalafons.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection