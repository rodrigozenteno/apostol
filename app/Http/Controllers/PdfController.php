<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use App\Models\Arma;
use App\Models\Diplomado;
use App\Models\Escalafon;
use App\Models\Especialidad;
use App\Models\Estado;
use App\Models\Grado;
use App\Models\Profocup;
use App\Models\Seguro;
use App\Models\User;
use App\Models\Matbel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function pdf_user($id)
    {
        //dd('PDF PARA IMPRIMIR DATOS DE USUARIO: '. $id);
        $user = User::find($id);
        $estados = Estado::all()->pluck('estado', 'id');
        $especialidads = Especialidad::all()->pluck('especialidad', 'id');
        $diplomados = Diplomado::all()->pluck('diplomado', 'id');
        $armas = Arma::all()->pluck('arma', 'id');
        $profocups = Profocup::all()->pluck('profocup', 'id');
        $alergias = alergias($user->id);
        $seguros = Seguro::all()->pluck('seguro', 'id');
        $escalafons = Escalafon::all()->pluck('escalafon', 'id');
        //dd($escalafons);
        if ($user->escalafon_user->escalafon_id == 1)//ARMAS
        {
            $grados = Grado::where('escalafon_id', 1)->pluck('grado', 'id');
            $band = 1;
            //dd($grados);
        }
        if ($user->escalafon_user->escalafon_id == 2)//EE.CC
        {
            $grados = Grado::where('escalafon_id', 2)->pluck('grado', 'id');
            $band = 2;
            //dd($grados);
        }
        if ($user->escalafon_user->escalafon_id == 3)//SERVICIOS
        {
            $grados = Grado::where('escalafon_id', 3)->pluck('grado', 'id');
            $band = 3;
            //dd($grados);
        }
        /* return view('apostol.pdfs.user_arma', compact(
            'user',
            'estados',
            'especialidads',
            'diplomados',
            'grados',
            'profocups',
            'armas',
            'alergias',
            'seguros',
            'escalafons',
            'band'
        )); */
        $pdf = PDF::loadView('apostol.pdfs.user_arma', compact(
            'user',
            'estados',
            'especialidads',
            'diplomados',
            'grados',
            'profocups',
            'armas',
            'alergias',
            'seguros',
            'escalafons',
            'band'
        ));
        $pdf->setPaper('letter');
        //$pdf->loadHTML('<h1>Test</h1>');
        $pdf->set_option('defaultFont', 'Arial');
        return $pdf->stream();
    }
        public function generarPDF()
    {
        // $data = [
        //     'titulo' => 'Información en PDF',
        //     'contenido' => 'Este es un ejemplo de cómo mostrar información en un archivo PDF en Laravel.'
        // ];
        $matbel = Matbel::all();

        $pdf = PDF::loadView('apostol.pdfs.informacion');

        return $pdf->stream('informacion.pdf');
    }
    
}
