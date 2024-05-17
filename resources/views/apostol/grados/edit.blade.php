@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para edición de grados</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['grados.update', $grado], 'method' => 'put']) !!}
        @csrf
        <div class="form-group">
            {{ Form::label('grado', 'GRADO') }}
            {{ Form::text('grado', $grado->grado, ['placeholder' => 'GENERAL DE EJÉRCITO', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('grado')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('abreviacion', 'ABREVIACIÓN') }}
            {{ Form::text('abreviacion', $grado->abreviacion, ['placeholder' => 'GRAL. EJTO.', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('abreviacion')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="escalafon_id">
            {{ Form::label('escalafon_id', 'ESCALAFÓN') }}
            {{ Form::select('escalafon_id', $escalafons, $grado->escalafon->id, ['class' => 'form-control select-escalafon', 'multiple', 'required']) }}
            @error('escalafon_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('grados.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-escalafon").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR ESCALAFÓN"
        });
    </script>
@endsection