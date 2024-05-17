@extends('apostol.plantilla')

@section('content_header')
    <h3>Formulario para edición de tipos de armamento</h3>
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

                    <form action="{{ url('update-tipo/'.$tipo_armamento->id) }}" method="POST" enctype="multipart/form-data" class="formulario-editar">
                    
                    @csrf
                    @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">tipo de armamento</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $tipo_armamento->nombre) }}">
                        </div>                 
                       
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary mb-6">Actualizar tipo de armamento</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_datatable')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('editar') == 'ok')
        <script>
            Swal.fire({
            title: "Editado!",
            text: "El dato se edito correctamente",
            icon: "success"
            });
        </script>
    @endif
    <script>
             $('.formulario-editar').submit(function (e) {
                e.preventDefault();
                Swal.fire({
                            title: "Actualizar?",
                            text: "Este dato se editara!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, editar!",
                            cancelButtonText: 'cancelar',
                            }).then((result) => {
                            if (result.isConfirmed) {
            
                                this.submit();
                            }
                            });
            });
        </script>
    @endsection