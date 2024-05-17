@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de relaciones</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['relacions.update', $relacion], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('relacion', 'RELACIÓN') }}
            {{ Form::text('relacion', $relacion->relacion, ['placeholder' => 'PICADURA DE ABEJA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('relacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('relacions.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection