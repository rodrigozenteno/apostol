@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Agregar datos de la pistola de dotación</h1>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
            
                        <a href="{{ url('matbels') }}" class="btn btn-secondary md-4">REGRESAR A LISTA</a>
            
                </div>
                <div class="card-body">

                    <form action="{{ url('add-matbel') }}" method="POST" enctype="multipart/form-data" >
                    
                    @csrf
                       
                        <div class="form-group mb-12">
                            <label for="">Grado</label>
                          <select name="grado_id" id="">
                            @foreach ($grados as $grado )
                            <option value="{{ $grado['id'] }}">{{ $grado['grado'] }}</option>
                            @endforeach
                          </select>
                          <label for="">Nombre Completo</label>
                             <select name="user_id" id="">
                            @foreach ($users as $user )
                            <option value="{{ $user['id'] }}">{{ $user->prim_nombre }} {{ $user->prim_apellido }}</option>
                            @endforeach
                          </select>
                        </div>

                        <!-- <div class="form-group mb-3">
                            <label for="">nombre completo</label>
                             <select name="user_id" id="">
                            @foreach ($users as $user )
                            <option value="{{ $user['id'] }}">{{ $user->prim_nombre }} {{ $user->prim_apellido }}</option>
                            @endforeach
                          </select>
                        </div> -->
                        <div class="form-group mb-3">
                            <label for="">Estado del armamento/Observaciones</label>
                            <textarea type="text" name="estado" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Celular</label>
                            <input type="int" name="cel" class="form-control">
                        </div>
                        <h4> Todo sobre el armamento</h4>
                        <div class="form-group mb-3">
                            <label for="">Marca</label>
                            <select name="marca_id" id="">
                            @foreach ($marcas as $marca )
                            <option value="{{ $marca['id'] }}">{{ $marca['marca'] }}</option>
                            @endforeach
                          </select>
                          <label for="">Industria</label>
                            <select name="marca_id" id="">
                            @foreach ($marcas as $marca )
                            <option value="{{ $marca['id'] }}">{{ $marca->industria->industria}}</option>
                            @endforeach
                          </select>
                          <label for="">Situacion</label>
                            <select name="situacion_id" id="">
                            @foreach ($situacions as $situacion )
                            <option value="{{ $situacion['id'] }}">{{ $situacion['situacion'] }}</option>
                            @endforeach
                          </select>
                          <label for="">Tipo</label>
                            <select name="tipo_armamento_id" id="">
                            @foreach ($tipo_armamentos as $tipo )
                            <option value="{{ $tipo['id'] }}">{{ $tipo['nombre']}}</option>
                            @endforeach
                          </select>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="">Industria</label>
                            <select name="marca_id" id="">
                            @foreach ($marcas as $marca )
                            <option value="{{ $marca['id'] }}">{{ $marca->industria->industria}}</option>
                            @endforeach
                          </select>
                        </div> -->
                        <div class="form-group mb-3">
                            <label for="">Cargar Imagen del Personal</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary center">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @section('js_bootstrap')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection --}}
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#matbels').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
   
@endsection