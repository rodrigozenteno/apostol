@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista</h1>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                        <h4>Actualizar datos</h4>
                        <a href="{{ url('matbels') }}" class="btn btn-primary-md-4">REGRESAR</a>
                    
                </div>
                <div class="card-body">

                    <form action="{{ url('update-matbel/'.$matbel->id) }}" method="POST" enctype="multipart/form-data" >                   
                    @csrf
                       @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">estado</label>
                            <input type="text" name="estado" class="form-control" value="{{ $matbel->estado }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Celular</label>
                            <input type="int" name="cel" class="form-control" value="{{ $matbel->cel }}">
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="">Imagen</label>
                            <input type="file" name="profile_image" class="form-control">
                            <img src="{{ asset('uploads/matbels/'.$matbel->profile_image) }}" width="100px" height="100px" alt="Image">
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