@extends('apostol.plantilla')

@section('content_header')
<h3>Formulario para registro de tipos de Armamento</h3>
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
                
                        <a href="{{ url('tipo_armamentos') }}" class="btn btn-secondary mb-4">REGRESAR</a>
                    
                </div>
                <div class="card-body">

                    <form action="{{ url('add-tipo') }}" method="POST" enctype="multipart/form-data" >
                    
                    @csrf
                    
                        <div class="form-group mb-3">
                            <label for="">tipo de armamento</label>
                            <input type="text" name="nombre" class="form-control">
                        </div>                 
                       
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary mb-6">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection