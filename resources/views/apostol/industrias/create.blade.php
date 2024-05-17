@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de industrias</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'industrias.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('industria', 'INDUSTRIA') }}
            {{ Form::text('industria', null, ['placeholder' => 'ARGENTINA', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('industria')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('industrias.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection