@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3>Formulario para registro de datos familiares</h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'datofamiliars.store', 'method' => 'post']) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('user_id', 'USUARIO') }}
            {{ Form::text('user_id', $user_id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('user_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="estado_id">
            {{ Form::label('relacion_id', 'RELACIÓN FAMILIAR') }}
            {{ Form::select('relacion_id', $relacions, null, ['class' => 'form-control select-relacion', 'multiple', 'required']) }}
            @error('relacion_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('prim_apellido', 'PRIMER APELLIDO') }}
            {{ Form::text('prim_apellido', null, ['placeholder' => 'CLAROS', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('prim_apellido')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('seg_apellido', 'SEGUNDO APELLIDO') }}
            {{ Form::text('seg_apellido', null, ['placeholder' => 'LÓPEZ', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('seg_apellido')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('nombres', 'NOMBRES') }}
            {{ Form::text('nombres', null, ['placeholder' => 'CECILIA ROMANET', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('nombres')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="grado_id">
            {{ Form::label('seguro_id', 'SEGURO') }}
            {{ Form::select('seguro_id', $seguros, null, ['class' => 'form-control select-seguro', 'multiple', 'required']) }}
            @error('seguro_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('c_seguro', 'CARNET DEL SEGURO') }}
            {{ Form::text('c_seguro', null, ['placeholder' => '830923GRR', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('c_seguro')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('datos.datos_complementarios', $user_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-relacion").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR RELACIÓN"
        });
        $(".select-seguro").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR RELACIÓN"
        });
    </script>
@endsection