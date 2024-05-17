@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de profesión/ocupación</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'profocups.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('profocup', 'PROFESIÓN/OCUPACIÓN') }}
            {{ Form::text('profocup', null, ['placeholder' => 'MÉDICO CIRUJANO', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('profocup')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('profocups.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection