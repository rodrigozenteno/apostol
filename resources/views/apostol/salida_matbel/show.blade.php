@extends('apostol.plantilla')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">Datos:  {{ $matbel->grado->abreviacion}} {{ $matbel->users->prim_nombre}} {{ $matbel->users->seg_nombre}} {{ $matbel->users->prim_apellido}} {{ $matbel->users->seg_apellido}} </h3>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('uploads/matbels/'.$matbel->profile_image) }}" width="150px" height="150px" alt="Image">
                            </div>
                            <div class="col-md-9">
                                <p>{!! QrCode::size(150)->generate(" $matbel->estado")  !!}</p>
                            </div>
                        </div>
                </div>
                
                <div class="panel-body">
                   
                    <div class="col-md-7">
                        
                        <div class="row">
                            <div class="col-md-3">
                                <p><b> Grado y Nombre Completo:</b></p>
                            </div>
                            <div class="col-md-9">
                              <p>{{ $matbel->grado->abreviacion}} {{ $matbel->users->prim_nombre}} {{ $matbel->users->seg_nombre}} {{ $matbel->users->prim_apellido}} {{ $matbel->users->seg_apellido}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>CI:</b></p>
                            </div>
                            <div class="col-md-9">
                        <p>{{ $matbel->users->ci}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Celular:</b></p>
                            </div>
                            <div class="col-md-9">
                                 <p>{{ $matbel->cel}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Email:</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $matbel->users->email}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Fecha Nacimiento:</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $matbel->users->f_nac}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>marca de dotacion:</b></p>
                            </div>
                            <div class="col-md-9">
                        <p>{{ $matbel->marca->marca}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Industria:</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $matbel->marca->industria->industria }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>tipo de armamento:</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $matbel->tipo_armamento->nombre }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>situación de armamento:</b></p>
                            </div>
                            <div class="col-md-9">
                                <p>{{ $matbel->situacion->situacion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p><b>Observaciones:</b></p>
                            </div>
                            <div class="col-md-9">
                               <p>{{ $matbel->estado}}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                        <a href="{{ url('matbels') }}" class="btn btn-secondary md-4">REGRESAR A LISTA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>


@endsection
{{-- @section('js_bootstrap')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection --}}
