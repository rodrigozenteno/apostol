@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de novedades</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'novedads.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('novedad', 'NOVEDAD') }}
            {{ Form::text('novedad', null, ['placeholder' => 'P.M.S. "EL FORTÍN"', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('novedad')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('novedads.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection