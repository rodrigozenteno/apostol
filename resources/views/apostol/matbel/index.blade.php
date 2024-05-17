@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>LISTA DE CODIGOS DE PISTOLA
                    </h4>
                        <a href="{{ url('add-matbel') }}" class="btn btn-secondary mb-4">Agregar personal con armamento</a>
                        <a href="{{ url('generar-pdf') }}" class="btn btn-danger float-end">Exportar a PDF</a>
                        <a href="{{ url('generar-pdf') }}" class="btn btn-primary float-end">Salida de armamento</a>
           
                </div>
                <div class="card-body">

                    <table id="table-matbel" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Imagen</th>
                                <th>Grado y Nombre Completo</th>
                                <th><center>Observaciones de la pistola de dotación</center> </th>
                                <th><center> Codigo Qr</center> </th>
                                <!-- <th>Marca</th>
                                <th>Industria</th> -->
                                <th>Información</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matbel as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ asset('uploads/matbels/'.$item->profile_image) }}" width="100px" height="100px" alt="Image">
                                </td>
                                <td>{{ $item->grado->abreviacion}} {{ $item->users->prim_nombre}} {{ $item->users->seg_nombre}} {{ $item->users->prim_apellido}} {{ $item->users->seg_apellido}}</td>  
                                <td>{{ $item->estado}}</td>
                                <!-- <td>{{ $item->marca->marca}}</td>
                                <td>{{ $item->marca->industria->industria }}</td>
                               -->
                               <td>  {!! QrCode::size(100)->generate(" $item->estado")  !!}</td>
                                <td>
                                    <a href="{{ url('show-matbel/'.$item->id) }}" class="btn btn-primary btn-sm">VER</a>
                                </td>
                                <td>
                                    <a href="{{ url('edit-matbel/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                                <td>
                                    {{-- <a href="{{ url('delete-matbel/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                                    <form action="{{ url('delete-matbel/'.$item->id) }}" method="POST" class="formulario-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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
            $('#table-matbel').DataTable();
        });
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire({
            title: "Eliminado!",
            text: "El dato se elimino correctamente",
            icon: "success"
            });
        </script>
    @endif
    <script>
             $('.formulario-eliminar').submit(function (e) {
                e.preventDefault();
                Swal.fire({
                            title: "Estas Seguro?",
                            text: "Este dato se eliminara definitivamente!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, eliminar!",
                            cancelButtonText: 'cancelar',
                            }).then((result) => {
                            if (result.isConfirmed) {
                                // Swal.fire({
                                // title: "Deleted!",
                                // text: "Your file has been deleted.",
                                // icon: "success"
                                // });
                                this.submit();
                            }
                            });
            });
            // Swal.fire({
            // title: "Are you sure?",
            // text: "You won't be able to revert this!",
            // icon: "warning",
            // showCancelButton: true,
            // confirmButtonColor: "#3085d6",
            // cancelButtonColor: "#d33",
            // confirmButtonText: "Yes, delete it!"
            // }).then((result) => {
            // if (result.isConfirmed) {
            //     Swal.fire({
            //     title: "Deleted!",
            //     text: "Your file has been deleted.",
            //     icon: "success"
            //     });
            // }
            // });


    </script>
@endsection