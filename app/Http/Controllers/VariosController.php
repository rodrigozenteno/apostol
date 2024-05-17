<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;

class VariosController extends Controller
{
    /* CONTROLADOR PARA CAMBIAR DATOS EN LA BD EN CASO DE SER NECESARIO */

    //MÉTODO PARA EDITAR EL GRUPO SANGUINEO DE 'OR+' Y 'OR-' A 'O+' Y 'O-'
    public function edit_gs()
    {
        //dd('aca estamos');
        $users = User::all();
        $cont_positivos = 0;
        $cont_negativos = 0;
        foreach ($users as $user) {
            if ($user->g_sang == 'ORH+') {
                $user->g_sang = 'O+';
                $user->save();
                $cont_positivos++;
            }
            if ($user->g_sang == 'ORH-') {
                $user->g_sang = 'O-';
                $user->save();
                $cont_negativos++;
            }
        }
        dd('SE CAMBIARON '.$cont_positivos.' POSITIVOS Y '.$cont_negativos.' NEGATIVOS');
    }
}
