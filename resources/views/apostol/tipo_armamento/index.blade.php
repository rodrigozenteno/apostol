@extends('apostol.plantilla')

@section('css_datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content_header')
    <h1>Lista de tipos de armamento</h1>
@endsection

@section('content')
    <a href="{{ url('add-tipo') }}" matbels>Registrar tipo de armamento</a>
    <a href="{{ url('matbels') }}" class="btn btn-secondary mb-4">volver a la lista</a>
   
        <table id="tipo_armamento" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <td>N°</td>
                    <td>TIPO DE ARMAMENTO</td>
                    <td>ACCIONES</td>
                </tr>
            </thead>
            @foreach ($tipo_armamento as $tipo)
               
                <tr>
                    <td>{{ $tipo->id}}</td>
                    <td>{{ $tipo->nombre }}</td>
                    <td><a href="{{url('edit-tipo', $tipo->id)}}" class="btn btn-secondary" title="EDITAR">EDITAR</a></td>
                    <td>
                     <form action="{{ url('delete-tipo/'.$tipo->id) }}" method="POST" class="formulario-eliminar">
                          @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                     </form>
                  </td>
                </tr>
            @endforeach
        </table>
   
@endsection
@section('js_datatable')
    <script>
        $(document).ready(function () {
            $('#tipo_armamento').DataTable();
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