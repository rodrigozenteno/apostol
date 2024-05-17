@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de relaciones</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'relacions.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('relacion', 'RELACIÓN') }}
            {{ Form::text('relacion', null, ['placeholder' => 'ESPOSA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('relacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('relacions.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection