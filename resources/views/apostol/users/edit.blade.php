@extends('apostol.plantilla')

@section('css_chosen')
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
@endsection

@section('content_header')
<h3><b>FORMULARIO PARA EDICIÓN DE DATOS DEL PERSONAL</b></h3>
@endsection

@section('content')
    {!! Form::open(['route' => ['users.update', $user], 'method' => 'put']) !!}
        @csrf
        <div class="form-group" id="estado_id">
            {{ Form::label('estado_id', 'ESTADO') }}
            {{ Form::select('estado_id', $estados, $user->datosmilitar->estado->id, ['class' => 'form-control select-estado', 'multiple', 'required']) }}
            @error('estado_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="escalafon_id">
            {{ Form::label('escalafon_id', 'ESCALAFÓN') }}
            {{ Form::select('escalafon_id', $escalafons, $user->datosmilitar->escalafon->id, ['class' => 'form-control select-escalafon', 'multiple', 'required']) }}
            @error('escalafon_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('ci', 'CARNET DE IDENTIDAD') }}
            {{ Form::number('ci', $user->ci, ['placeholder' => '5529948', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()', 'min' =>'1']) }}
            @error('ci')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('comp', 'COMPLEMENTO') }}
            {{ Form::text('comp', $user->comp, ['placeholder' => 'INGRESE COMPLEMENTO', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('comp')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('ext', 'EXTENSIÓN') }}
            {{ Form::select('ext', ['PT' => 'PT', 'LP' => 'LP', 'OR' => 'OR', 'CB' => 'CB', 'TJ' => 'TJ', 'CH' => 'CH', 'SC' => 'SC', 'BN' => 'BN', 'PD' => 'PD'], $user->ext, ['placeholder' => 'SELECCIONE EXTENSIÓN', 'class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('c_militar', 'CARNET MILITAR') }}
            {{ Form::text('c_militar', $user->carnet->c_militar, ['placeholder' => '07102053', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('c_militar')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="grado_id">
            {{ Form::label('seguro_id', 'SEGURO') }}
            {{ Form::select('seguro_id', $seguros, $user->carnet->seguro->id, ['class' => 'form-control select-seguro', 'multiple', 'required']) }}
            @error('seguro_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('c_seguro', 'CARNET DEL SEGURO') }}
            {{ Form::text('c_seguro', $user->carnet->c_seguro, ['placeholder' => '830923GRR', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('c_seguro')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('papeleta', 'PAPELETA DE PAGO') }}
            {{ Form::text('papeleta', $user->papeleta, ['placeholder' => '00018588', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('papeleta')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="grado_id">
            {{ Form::label('grado_id', 'GRADO') }}
            {{ Form::select('grado_id', $grados, grado($user->id, 'edit'), ['class' => 'form-control select-grado', 'multiple', 'required']) }}
            @error('grado_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="diplomado_id">
            {{ Form::label('diplomado_id', 'DIPLOMADO') }}
            {{ Form::select('diplomado_id', $diplomados, diplomado($user->id, 'edit'), ['class' => 'form-control select-diplomado', 'multiple']) }}
            @error('diplomado_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        @if($escalafon_id == 1)
            <div class="form-group" id="arma_id">
                {{ Form::label('arma_id', 'ARMA') }}
                {{ Form::select('arma_id', $armas, arma($user->id, 'edit'), ['class' => 'form-control select-arma', 'multiple', 'required']) }}
                @error('arma_id')
                <small>* {{$message}}</small>
                <br>
                @enderror
            </div>
        @endif
        @if($escalafon_id != 1)
            <div class="form-group" id="profocup_id">
                {{ Form::label('profocup_id', 'PROFESIÓN/OCUPACIÓN') }}
                {{ Form::select('profocup_id', $profocups, profocup($user->id, 'edit'), ['class' => 'form-control select-arma', 'multiple', 'required']) }}
                @error('profocup_id')
                <small>* {{$message}}</small>
                <br>
                @enderror
            </div>
        @endif
        
        <div class="form-group">
            {{ Form::label('prim_nombre', 'PRIMER NOMBRE') }}
            {{ Form::text('prim_nombre', $user->prim_nombre, ['placeholder' => 'HORACIO', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('prim_nombre')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('seg_nombre', 'SEGUNDO NOMBRE') }}
            {{ Form::text('seg_nombre', $user->seg_nombre, ['placeholder' => 'GERARDO', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('prim_nombre')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('prim_apellido', 'PRIMER APELLIDO') }}
            {{ Form::text('prim_apellido', $user->prim_apellido, ['placeholder' => 'PURICELLI', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('prim_nombre')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('seg_apellido', 'SEGUNDO APELLIDO') }}
            {{ Form::text('seg_apellido', $user->seg_apellido, ['placeholder' => 'KOVASIC', 'class' => 'form-control', 'required', 'style' => 'text-transform:uppercase', 'onkeyup' =>'javascript:this.value=this.value.toUpperCase()']) }}
            @error('prim_nombre')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('ant', 'ANTIGÜEDAD EN EL CURSO') }}
            {{ Form::number('ant', $user->ant, ['placeholder' => '1', 'class' => 'form-control', 'required', 'min' =>'1', 'max' =>'300']) }}
            @error('ant')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('l_nac', 'LUGAR DE NACIMIENTO') }}
            {{ Form::select('departamento_id', $departamentos, null, ['class' => 'form-control', 'placeholder' => 'CLICK PARA SELECCIONAR DEPARTAMENTO','required', 'id' => 'select_departamento']) }}
            @error('departamento_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="provincia_id">
            <select name="provincia_id" id="select_provincia" class="form-control" required>
                <option value="">CLICK PARA SELECCIONAR PROVINCIA</option>
            </select>
            @error('provincia_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group" id="municipio_id">
            <select name="municipio_id" id="select_municipio" class="form-control" required>
                <option value="">CLICK PARA SELECCIONAR MUNICIPIO</option>
            </select>
            @error('municipio_id')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('f_nac', 'FECHA DE NACIMIENTO') }}
            {{ Form::date('f_nac', $user->f_nac, ['class' => 'form-control', 'required']) }}
            @error('f_nac')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('e_civil', 'ESTADO CIVIL') }}
            {{ Form::select('e_civil', ['SOLTERO' => 'SOLTERO', 'CASADO' => 'CASADO', 'VIUDO' => 'VIUDO', 'DIVORCIADO' => 'DIVORCIADO', 'EN UNIÓN LIBRE' => 'EN UNIÓN LIBRE'], $user->e_civil, ['placeholder' => 'SELECCIONE ESTADO CIVIL', 'class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('sexo', 'GÉNERO') }}
            {{ Form::select('sexo', ['MASCULINO' => 'MASCULINO', 'FEMENINO' => 'FEMENINO'], $user->sexo, ['placeholder' => 'SELECCIONE UN SEXO', 'class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('g_sang', 'GRUPO SANGUINEO') }}
            {{ Form::select('g_sang', ['A+' => 'A+','A-' => 'A-','B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'], $user->g_sang, ['placeholder' => 'SELECCIONE GRUPO SANGUINEO', 'class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('alergias', 'ALERGIAS') }}
            {{ Form::select('alergias[]', $alergias, $user->alergias, ['class' => 'form-control select-alergias', 'multiple']) }}
        </div>
        <div class="form-group">
            {{ Form::label('f_alt', 'FECHA DE ALTA EN LA INSTITUCIÓN') }}
            {{ Form::date('f_alt', $user->f_alt, ['class' => 'form-control', 'required']) }}
            @error('f_alt')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('email', 'CORREO ELECTRÓNICO') }}
            {{ Form::email('email', $user->email, ['placeholder' => 'gcaesis@gmail.com', 'class' => 'form-control', 'required']) }}
            @error('email')
            <small>* {{$message}}</small>
            <br>
            @enderror
        </div>
        <a href="{{route('users.index')}}" class="btn btn-secondary">CANCELAR</a>
        {{ Form::submit('EDITAR', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection

@section('js_chosen')
    <script src="{{ asset('plugins/jquery/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(".select-estado").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR ESTADO"
        });
        $(".select-escalafon").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR ESCALAFÓN"
        });
        $(".select-seguro").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR SEGURO"
        });
        $(".select-grado").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR GRADO"
        });
        $(".select-diplomado").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR DIPLOMADO"
        });
        $(".select-arma").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR ARMA"
        });
        $(".select-departamento").chosen({
            max_selected_options: 1,
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR DEPARTAMENTO"
        });
        $(".select-alergias").chosen({
            no_results_text: "No hay coincidencias con la búsqueda!",
            width: "100%",
            placeholder_text_multiple: "CLICK PARA SELECCIONAR ALERGIA"
        });
    </script>
@endsection
@section('js_script')
    <script src="{{ asset('js/municipios/create.js') }}"></script>
@endsection

@section('js_script2')
    <script src="{{ asset('js/users/create.js') }}"></script>
@endsection