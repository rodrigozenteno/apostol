@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de seguros</h3>
@endsection
    
@section('content')
    {!! Form::open(['route' => ['seguros.update', $seguro], 'method' => 'put']) !!}
        @csrf

        <div class="form-group">
            {{ Form::label('seguro', 'SEGURO') }}
            {{ Form::text('seguro', $seguro->seguro, ['placeholder' => 'CAJA NACIONAL DE SALUD', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('seguro')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('seguros.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection