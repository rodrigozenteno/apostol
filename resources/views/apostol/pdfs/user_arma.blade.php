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
            <td>DEPARTAMENTO III - OPERACIONES</td>
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
    <br>
    <h1>FILIACIÓN PERSONAL DEL {{ grado_nombre_completo($user->id)}}</h1>
    <br>
    <table id="datos_user">
        <tr>
            <td class="item">GRADO</td>
            <td class="item">:</td>
            <td class="contenido">{{ grado($user->id, 'show') }}</td>
        </tr>
        <tr>
            <td class="item">ARMA DE ORIGEN Y ESPECIALIDAD</td>
            <td class="item">:</td>
            <td class="contenido">{{ arma($user->id, 'pdf')}} {{ diplomado($user->id, 'index')}}</td>
        </tr>
        <tr>
            <td class="item">NOMBRES Y APELLIDOS</td>
            <td class="item">:</td>
            <td class="contenido">{{ nombre_completo($user->id) }}</td>
        </tr>
        <tr>
            <td class="item">LUGAR Y FECHA DE NACIMIENTO</td>
            <td class="item">:</td>
            <td class="contenido">{{ l_nac($user->id) }}, {{ $user->f_nac }}</td>
        </tr>
        <tr>
            <td class="item">FECHA DE INCORPORACIÓN</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->f_alt }}</td>
        </tr>
        <tr>
            <td class="item">CÉDULA DE IDENTIDAD</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->ci }}</td>
        </tr>
        <tr>
            <td class="item">NÚMERO DE CARNET MILITAR</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->carnet->c_militar }}</td>
        </tr>
        <tr>
            <td class="item">MATRÍCULA DEL SEGURO DE SALUD</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->carnet->c_seguro }}</td>
        </tr>
        <tr>
            <td class="item">GRUPO SANGUÍNEO</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->g_sang }}</td>
        </tr>
        <tr>
            <td class="item">INSTITUTO DE EGRESO</td>
            <td class="item">:</td>
            <td class="contenido">Contenido</td>
        </tr>
        <tr>
            <td class="item">ALERGIAS</td>
            <td class="item">:</td>
            <td class="contenido">{{ $alergias }}</td>
        </tr>
        <tr>
            <td class="item">ESTADO CIVIL</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->e_civil }}</td>
        </tr>
        <tr>
            <td class="item">DOMICILIO ACTUAL</td>
            <td class="item">:</td>
            <td class="contenido">Contenido</td>
        </tr>
        <tr>
            <td class="item">NOMBRE DE LOS HIJOS</td>
            <td class="item">:</td>
            <td class="contenido">Contenido</td>
        </tr>
        <tr>
            <td class="item">NOMBRE DEL ESPOSO/A</td>
            <td class="item">:</td>
            <td class="contenido">Contenido</td>
        </tr>
        <tr>
            <td class="item">NÚMERO DE CELULAR</td>
            <td class="item">:</td>
            <td class="contenido">Contenido</td>
        </tr>
        <tr>
            <td class="item">CORREO ELECTRÓNICO</td>
            <td class="item">:</td>
            <td class="contenido">{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="item">CONTACTO DE EMERGENCIA</td>
            <td class="item">:</td>
            <td class="contenido">Contenido</td>
        </tr>
    </table>
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
            $('#users').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
@endsection