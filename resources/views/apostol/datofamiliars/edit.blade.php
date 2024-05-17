@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
    <h3>Formulario para edición de datos familiares</h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['datofamiliars.update', $datofamiliar], 'method' => 'put']) !!}
    @csrf
    <div class="form-group" id="estado_id">
        {{ Form::label('relacion_id', 'RELACIÓN FAMILIAR') }}
        {{ Form::select('relacion_id', $relacions, $datofamiliar->relacion_id, ['class' => 'form-control select-relacion', 'multiple', 'required']) }}
        @error('relacion_id')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('prim_apellido', 'PRIMER APELLIDO') }}
        {{ Form::text('prim_apellido', $datofamiliar->prim_apellido, ['placeholder' => 'CLAROS', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
        @error('prim_apellido')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('seg_apellido', 'SEGUNDO APELLIDO') }}
        {{ Form::text('seg_apellido', $datofamiliar->seg_apellido, ['placeholder' => 'LÓPEZ', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
        @error('seg_apellido')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('nombres', 'NOMBRES') }}
        {{ Form::text('nombres', $datofamiliar->nombres, ['placeholder' => 'CECILIA ROMANET', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
        @error('nombres')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group" id="grado_id">
        {{ Form::label('seguro_id', 'SEGURO') }}
        {{ Form::select('seguro_id', $seguros, $datofamiliar->seguro_id, ['class' => 'form-control select-seguro', 'multiple', 'required']) }}
        @error('seguro_id')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('c_seguro', 'CARNET DEL SEGURO') }}
        {{ Form::text('c_seguro', $datofamiliar->c_seguro, ['placeholder' => '830923GRR', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
        @error('c_seguro')
        <small>* {{$message}}</small>
        <br>
        @enderror
    </div>
    <a href="{{route('datos.datos_complementarios', $datofamiliar->user_id)}}" class="btn btn-secondary">CANCELAR</a>
    {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
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