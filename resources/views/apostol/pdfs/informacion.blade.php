@extends('apostol.plantilla_pdfs')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ public_path('css\pdf_user.css') }}">{{-- public_path css PARA GENERACIÓN DE PDF --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/pdf_user.css') }}"> {{-- asset css PARA GENERACIÓN DE HTML --}}
@endsection

@section('title', 'PDFS')

@section('content')
    <table id="membrete">
        <tr>
            <td>DIRECCIÓN GENERAL OPS. AÉ. DEL EJÉRCITO</td>
        </tr>
        <tr>
            <td>GRUPO DE CABALLERÍA AÉREA DEL EJÉRCITO</td>
        </tr>
        <tr>
            <td>"GRAL. APÓSTOL SANTIAGO"</td>
        </tr>
        <tr>
            <td id="bolivia">BOLIVIA</td>
        </tr>
    </table>
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">

                    <table id="table-matbel" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Grado Nombre Completo</th>
                                <th>estado</th>
                                <th>marca</th>
                                <th>industria</th>
                                <th>Imagen</th>
                                <th>qr</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(306.04, 731.43, "$PAGE_NUM - $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
    <script>
        $(document).ready(function () {
            $('table-matbel').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection