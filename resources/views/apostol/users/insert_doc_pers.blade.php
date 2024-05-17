@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3><b>INSERCIÓN DE DOCUMENTO PARA EL {{grado_nombre_completo($user_id)}}</b></h3>
@endsection

@section('content')
    {!! Form::open(['route' => 'users.store_documento', 'method' => 'post', 'files' => true]) !!}
        @csrf
        <div class="form-group" id="user_id" style="display: none">
            {{ Form::label('user_id', 'USUARIO') }}
            {{ Form::text('user_id', $user_id, ['class' => 'form-control', 'required', 'readonly']) }}
            @error('user_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="documento_id">
            {{ Form::label('documento_id', 'DOCUMENTO') }}
            {{ Form::select('documento_id', $documentos, $doc_id, ['class' => 'form-control select-documento', 'multiple', 'required']) }}
            @error('documento_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('f_ven', 'FECHA DE VENCIMIENTO DEL DOCUMENTO') }}
            {{ Form::date('f_ven', null, ['class' => 'form-control', 'min' => $fecha_actual]) }}
            @error('f_ven')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('image', 'IMAGEN') }}
            {{ Form::file('image', ['class' => 'form-control','required']) }}
            @error('image')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('users.index_documentos_personales', $user_id)}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('REGISTRAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-documento").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR DOCUMENTO"
        });
        $('.select-documento').trigger('chosen:close');
    </script>
@endsection

@section('js_sweetalert')
    <script src="sweetalert2.all.min.js"></script>
@endsection