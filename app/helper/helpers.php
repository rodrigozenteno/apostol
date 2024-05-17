<?php

use App\Models\Destino;
use App\Models\Destino_Novedad;
use App\Models\Documento;
use App\Models\Documento_User;
use App\Models\Estado;
use App\Models\Grado_User;
use App\Models\Novedad;
use App\Models\Unidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Else_;

use function PHPUnit\Framework\isEmpty;

function grado_nombre_completo($id)
{
    //dd($id);
    return grado($id, 'index').' '.diplomado($id, 'index').' '. nombre_completo(($id));
}

function grado($id, $view){
    $user = User::find($id);
    //dd($user);
    if ($view == 'edit') {
        return $user->datosmilitar->grado->id;
    }
    if ($view == 'show') {
        return $user->datosmilitar->grado->grado;
    }
    return $user->datosmilitar->grado->abreviacion;
}

function diplomado($id, $view){
    //return 'si tiene o no diplomado';
    $user = User::find($id);
    $diplomado = $user->datosmilitar->diplomado;
    if ($diplomado == null)
    {
        if ($view == 'edit' || $view == 'show') {
            return '';
        }
        if ($user->datosmilitar->escalafon->id == 1)//ARMAS
        {
            return arma($id, $view);
        }
        else//ES DE SERVICIOS O EE.CC.
        {
            return profocup($id, $view);
        }
    }
    else
    {
        if ($view == 'show') {
            return $user->datosmilitar->diplomado->diplomado;
        }
        if ($view == 'edit') {
            return $user->datosmilitar->diplomado->id;
        }
        if ($view == 'index') {
            return $user->datosmilitar->diplomado->abreviacion;
        }
    }
}

function verif_dip($id)
{
    $user = User::find($id);
    return $user->diplomados_users->last();
}

function arma($id, $view)
{
    $user = User::find($id);
    $arma = $user->datosmilitar->arma;
    if ($view == 'show') {
        return $arma->arma;
    }
    if ($view == 'edit') {
        return $arma->id;
    }
    return $arma->abreviacion;
}

function profocup($id, $view)
{
    $user = User::find($id);
    $profocup = $user->datosmilitar->profocup;
    if ($view == 'edit') {
        return $profocup->id;
    }
    return $profocup->profocup;
}

function estado_user($id, $view){
    $user = User::find($id);
    $estado_user = $user->datosmilitar->estado;
    if ($view == 'edit') {
        return $estado_user->id;
    }
    return estado($estado_user->id);
}

function estado($id){
    $estado = Estado::find($id);
    return $estado->estado;
}

function escalafon_user($id, $view){
    $user = User::find($id);
    $escalafon_user = $user->escalafon_user;
    //dd($escalafon_user);
    if ($view == 'edit') {
        //dd($escalafon_user->escalafon->id);
        return $escalafon_user->escalafon->id;
    }
    //dd($escalafon_user->escalafon->escalafon);
    return $escalafon_user->escalafon->escalafon;
}

function l_nac($id){
    $user = User::find($id);
    $l_nac = $user->municipio_user->municipio->provincia->departamento->departamento.'-'.$user->municipio_user->municipio->provincia->provincia.'-'.$user->municipio_user->municipio->municipio;
    return $l_nac;
}

function departamento($id){
    $user = User::find($id);
    return $user->municipio_user->municipio->provincia->departamento->id;
}

function verif_doc($doc_id, $id)
{
    //$doc_id => ID DEL TIPO DE DOCUMENTO QUE SE VA A VERIFICAR
    //$id => ID DEL USUARIO
    $documento_user = Documento_User::where('documento_id', $doc_id)->where('user_id', $id)->count();
    return $documento_user;
}

function verif_valid($doc_id, $id)
{
    //$doc_id => ID DEL TIPO DE DOCUMENTO QUE SE VA A VERIFICAR
    //$id => ID DEL USUARIO
    $documento_user = Documento_User::where('documento_id', $doc_id)->where('user_id', $id)->where('user_verified', '<>', null)->count();
    //dd($documento_user);
    return $documento_user;
}

function documento_user_id($doc_id, $id)
{
    $documento_user = Documento_User::where('documento_id', $doc_id)->where('user_id', $id)->first();
    //dd($documento_user);
    return $documento_user->id;
}

function verif_f_ven($doc_id, $id)
{
    $documento_user = Documento_User::where('documento_id', $doc_id)->where('user_id', $id)->first();
    //dd($documento_user->f_ven);
    if ($documento_user) {
        return $documento_user->f_ven;
    }
    return null;
}

function documento($doc_id)
{
    $documento = Documento::find($doc_id);
    return $documento->documento;
}

function nombre_completo($id){
    $user = User::find($id);
    $nombre_completo = $user->prim_nombre.' '.$user->seg_nombre.' '.$user->prim_apellido.' '.$user->seg_apellido;
    return $nombre_completo;
}

function alergias($id){
    $user = User::find($id);
    $alergias = $user->alergias;
    if (count($alergias) > 1)
    {
        $contador = 0;
        $texto_alergias = '';
        foreach ($alergias as $alergia)
        {
            if ($contador == 0)
            {
                $texto_alergias = $alergia->alergia;
            }
            else
            {
                $texto_alergias = $texto_alergias.', '.$alergia->alergia;
            }
            $contador = $contador+1;
        }
        return $texto_alergias;
    }
    if (count($alergias) == 1)
    {
        return $alergias->alergia;
    }
    return 'N/A';
}

function tipo_user($id)
{
    $user = User::find($id);
    if ($user->escalafon_user->escalafon_id == 1)//ARMA
    {
        return 1;
    }
    if ($user->escalafon_user->escalafon_id == 2)//EE.CC.
    {
        return 2;
    }
    if ($user->escalafon_user->escalafon_id == 3)//SERVICIOS
    {
        return 3;
    }
}

function noms_aps($id, $dato)
{
    $user = User::find($id);
    if ($dato == 'prim')
    {
        return $user->prim_apellido;
    }
    if ($dato == 'seg')
    {
        return $user->seg_apellido;
    }
    if ($dato == 'nom')
    {
        return $user->prim_nombre.' '.$user->seg_nombre;
    }
}

function ci($id)
{
    $user = User::find($id);
    return $user->ci;
}

function cmilitar($id)
{
    $user = User::find($id);
    return $user->carnet->c_militar;
}

function cseguro($id)
{
    $user = User::find($id);
    return $user->carnet->c_seguro;
}

function destino_user($id)
{
    //$user = User::find($id);
    $destino = Destino::where('user_id', $id)
        ->where('estado', 1)
    ->first();
    //dd($destino);
    if ($destino == null) {
        return 'POR ASIGNAR';
    } else {
        return $destino->unidad->abrev;
    }
}

function destino($id)
{
    $destino = Destino::where('user_id', $id)->where('estado', 1)->first();
    return $destino;
}

function destino_desde($id)
{
    $destino = destino($id);
    return $destino->f_ini;
}

function verificar_novedad($id)
{
    $destino = destino($id);
    //dd($destino);
    //return $destino;//RETORNA EL DESTINO ACTUAL DEL USUARIO, estado=actual
    $desde = substr(Carbon::now()->toDateTimeString(),0,10);
    $destino_novedad = DB::table('destino_novedad')
            ->where([['destino_id', $destino->id], ['desde' , '<=', $desde] , ['hasta', '>=', $desde]])
            ->orWhere([['destino_id', $destino->id],['desde',  '<=', $desde] , ['hasta', '=', null]])
    ->select('destino_novedad.id')
    ->pluck('id')
    ->first();
    //dd($destino_novedad);
    return $destino_novedad;//RETORNA EL ID DE LA NOVEDAD
}

function ver_novedad($id)
{
    $destino_novedad = Destino_Novedad::find(verificar_novedad(($id)));
    return $destino_novedad->novedad->novedad;
}

function novedad_desde($id)
{
    $destino_novedad = Destino_Novedad::find(verificar_novedad(($id)));
    return $destino_novedad->desde;
}

function novedad_hasta($id)
{
    $destino_novedad = Destino_Novedad::find(verificar_novedad(($id)));
    if ($destino_novedad == null) {
        return 'NUEVA ORDEN';
    }
    return $destino_novedad->hasta;
}

function novedad_cantidad($unidad_id, $novedad_id, $escalafon)
{
    //dd('id del registro de destino_novedad: '.$id.', id asignado del escalafón: '.$escalafon);
    //return 'unidad->id: '.$unidad_id.', escalafon: '.$escalafon;
    $unidad = Unidad::find($unidad_id);
    $hoy = substr(Carbon::now()->toDateTimeString(),0,10);
    ///////////////////////////////////////////////////////////////////////
    //NOVEDADES DEL DÍA DE HOY PARA EL DESTINO SELECCIONADO
    $destino_novedad = DB::table('destino_novedad')
        ->join('destinos', 'destino_novedad.destino_id', '=', 'destinos.id')
            ->where([['destinos.unidad_id', $unidad->id], ['destino_novedad.desde' , '<=', $hoy] , ['destino_novedad.hasta', '>=', $hoy]])
            ->orWhere([['destinos.unidad_id', $unidad->id], ['destino_novedad.desde',  '<=', $hoy] , ['destino_novedad.hasta', '=', null]])
    ->select('destinos.user_id','destino_novedad.novedad_id', 'destino_novedad.id', 'destino_novedad.desde', 'destino_novedad.hasta', 'destino_novedad.obs')
    ->get();
    //$novedads = Novedad::all();
    $cont_escalafon = 0;
    foreach ($destino_novedad as $dest_nov) {
        if ($dest_nov->novedad_id == $novedad_id) {
            $user = User::find($dest_nov->user_id);
            $grado_user = $user->datosmilitar;
            //dd('ID DEL USUARIO: '.$user->id.' GRADO DEL USUARIO: '.$grado_user->grado->abreviacion);
            if ($user->datosmilitar->escalafon->escalafon == 'ARMAS') {
                if (($grado_user->grado->abreviacion == 'TCNL.' || $grado_user->grado->abreviacion == 'MY.') && $escalafon == '1') {
                    $cont_escalafon++;
                }
                if (($grado_user->grado->abreviacion == 'CAP.' || $grado_user->grado->abreviacion == 'TTE.' || $grado_user->grado->abreviacion == 'SBTTE.') && $escalafon == '2') {
                    $cont_escalafon++;
                }
                if ($grado_user->grado->abreviacion == 'SOF. MTRE.' || $grado_user->grado->abreviacion == 'SOF. MY.' || $grado_user->grado->abreviacion == 'SOF. 1RO.' || $grado_user->grado->abreviacion == 'SOF. 2DO.' || $grado_user->grado->abreviacion == 'SOF. INCL.') {
                    if ($user->datosmilitar->arma->arma != 'MÚSICA' && $escalafon == 3) {
                        $cont_escalafon++;
                    }
                    if ($user->datosmilitar->arma->arma == 'MÚSICA' && $escalafon == 5) {
                        $cont_escalafon++;
                    }
                }
                if ($grado_user->grado->abreviacion == 'SGTO. 1RO.' || $grado_user->grado->abreviacion == 'SGTO. 2DO.' || $grado_user->grado->abreviacion == 'SGTO. INCL.') {
                    if ($user->datosmilitar->arma->arma != 'MÚSICA' && $escalafon == 4) {
                        $cont_escalafon++;
                    }
                    if ($user->datosmilitar->arma->arma == 'MÚSICA' && $escalafon == 6) {
                        $cont_escalafon++;
                    }
                }
            }
            if ($user->datosmilitar->escalafon->escalafon == 'SERVICIOS') {
                if (($grado_user->grado->abreviacion == 'CNL. SERV.' || $grado_user->grado->abreviacion == 'TCNL. SERV.' || $grado_user->grado->abreviacion == 'MY. SERV.' || $grado_user->grado->abreviacion == 'CAP. SERV.' || $grado_user->grado->abreviacion == 'TTE. SERV.' || $grado_user->grado->abreviacion == 'SBTTE. SERV.') && $escalafon == '7') {
                    $cont_escalafon++;
                }
                if (($grado_user->grado->abreviacion == 'SOF. MTRE.' || $grado_user->grado->abreviacion == 'SOF. MY.' || $grado_user->grado->abreviacion == 'SOF. 1RO.' || $grado_user->grado->abreviacion == 'SOF. 2DO.' || $grado_user->grado->abreviacion == 'SOF. INCL.') && $escalafon == '8') {
                    $cont_escalafon++;
                }
                if (($grado_user->grado->abreviacion == 'SGTO. 1RO.' || $grado_user->grado->abreviacion == 'SGTO. 2DO.' || $grado_user->grado->abreviacion == 'SGTO. INCL.') && $escalafon == '9') {
                    $cont_escalafon++;
                }
            }
            if ($user->datosmilitar->escalafon->escalafon == 'EE. CC.') {
                if (($grado_user->grado->abreviacion == 'PROF. V' || $grado_user->grado->abreviacion == 'PROF. IV' || $grado_user->grado->abreviacion == 'PROF. III' || $grado_user->grado->abreviacion == 'PROF. II' || $grado_user->grado->abreviacion == 'PROF. I') && $escalafon == '10') {
                    $cont_escalafon++;
                }
                if (($grado_user->grado->abreviacion == 'TÉC. V' || $grado_user->grado->abreviacion == 'TÉC. IV' || $grado_user->grado->abreviacion == 'TÉC. III' || $grado_user->grado->abreviacion == 'TÉC. II' || $grado_user->grado->abreviacion == 'TÉC. I') && $escalafon == '11') {
                    $cont_escalafon++;
                }
                if (($grado_user->grado->abreviacion == 'ADM. V' || $grado_user->grado->abreviacion == 'ADM. IV' || $grado_user->grado->abreviacion == 'ADM. III' || $grado_user->grado->abreviacion == 'ADM. II' || $grado_user->grado->abreviacion == 'ADM. I') && $escalafon == '12') {
                    $cont_escalafon++;
                }
                if (($grado_user->grado->abreviacion == 'APAD. V' || $grado_user->grado->abreviacion == 'APAD. IV' || $grado_user->grado->abreviacion == 'APAD. III' || $grado_user->grado->abreviacion == 'APAD. II' || $grado_user->grado->abreviacion == 'APAD. I') && $escalafon == '13') {
                    $cont_escalafon++;
                }
            }
        }
    }
    return $cont_escalafon;
}

function no_disponibles($unidad_id, $escalafon)
{
    //DEBO OBTENER LA SUMATORIA DE LAS NOVEDADES DE CADA ESCALÓN
    $novedads = Novedad::all();
    $no_disp_escalafon = 0;
    foreach ($novedads as $novedad) {
        $no_disp_escalafon = $no_disp_escalafon + novedad_cantidad($unidad_id, $novedad->id, $escalafon);
    }
    return $no_disp_escalafon;
}

function no_disponibles_total($unidad_id)
{
    $no_disp_total = 0;
    $arreglo = ['1','2','3','4','5','6','7','8','9','10','11','12','13'];
    foreach ($arreglo as $esc) {
        $no_disp_total = $no_disp_total + no_disponibles($unidad_id, $esc);
    }
    return $no_disp_total;
}

function destinados($id)
{
    //INDEX QUERY ORDENADO POR ESCALAFONES Y ANTIGUEDAD
    $destinados = DB::table('users')
        ->join('datosmilitars', 'users.id', '=', 'datosmilitars.user_id')
            ->orderBy('datosmilitars.escalafon_id', 'asc')
            ->orderBy('datosmilitars.grado_id', 'asc')
            ->orderBy('users.f_alt', 'asc')
            ->orderBy('users.ant', 'asc')
        ->join('destinos', 'users.id', '=', 'destinos.user_id')
            ->where('destinos.unidad_id', $id)
            ->where('destinos.estado', '1')
    ->select('users.id')
    ->pluck('id');
    //dd($destinados);
    return $destinados;
}

function destino_novedad($unidad, $hoy)
{
    $destino_novedad = DB::table('destino_novedad')
        ->join('destinos', 'destino_novedad.destino_id', '=', 'destinos.id')
            ->where([['destinos.unidad_id', $unidad->id], ['destino_novedad.desde' , '<=', $hoy] , ['destino_novedad.hasta', '>=', $hoy]])
            ->orWhere([['destinos.unidad_id', $unidad->id], ['destino_novedad.desde',  '<=', $hoy] , ['destino_novedad.hasta', '=', null]])
    ->select('destinos.user_id','destino_novedad.novedad_id', 'destino_novedad.id', 'destino_novedad.desde', 'destino_novedad.hasta', 'destino_novedad.obs')
    ->get();
    return $destino_novedad;
}

function efectivos_personal($unidad_id, $clase_personal)
{
    $destinados = destinados($unidad_id);
    //dd($destinados);
    $cont = 0;
    //dd($cont);
    foreach ($destinados as $destinado) {
        //dd($destinado);
        $user = User::find($destinado);
        //dd($user);
        $grado_user = $user->datosmilitar;
        //dd($grado_user->grado->abreviacion);
        if ($user->datosmilitar->escalafon->escalafon == 'ARMAS') {
            //dd($user->ci);
            if (($grado_user->grado->abreviacion == 'TCNL.' || $grado_user->grado->abreviacion == 'MY.') && $clase_personal == 1) {
                $cont++;
            }
            if (($grado_user->grado->abreviacion == 'CAP.' || $grado_user->grado->abreviacion == 'TTE.' || $grado_user->grado->abreviacion == 'SBTTE.') && $clase_personal == 2) {
                $cont++;
            }
            if (($grado_user->grado->abreviacion == 'SOF. MTRE.' || $grado_user->grado->abreviacion == 'SOF. MY.' || $grado_user->grado->abreviacion == 'SOF. 1RO.' || $grado_user->grado->abreviacion == 'SOF. 2DO.' || $grado_user->grado->abreviacion == 'SOF. INCL.') && ($clase_personal == 3 || $clase_personal == 5)) {
                if ($user->datosmilitar->arma->arma == 'MÚSICA' && $clase_personal == 5) {
                    $cont++;
                }
                if ($user->datosmilitar->arma->arma != 'MÚSICA' && $clase_personal == 3) {
                    $cont++;
                }
            }
            if (($grado_user->grado->abreviacion == 'SGTO. 1RO.' || $grado_user->grado->abreviacion == 'SGTO. 2DO.' || $grado_user->grado->abreviacion == 'SGTO. INCL.') && ($clase_personal == 4 || $clase_personal == 6)) {
                if ($user->datosmilitar->arma->arma == 'MÚSICA' && $clase_personal == 6) {
                    $cont++;
                }
                if ($user->datosmilitar->arma->arma != 'MÚSICA' && $clase_personal == 4) {
                    $cont++;
                }
            }
        }
        if ($user->datosmilitar->escalafon->escalafon == 'SERVICIOS') {
            if (($grado_user->grado->abreviacion == 'CNL. SERV.' || $grado_user->grado->abreviacion == 'TCNL. SERV.' || $grado_user->grado->abreviacion == 'MY. SERV.' || $grado_user->grado->abreviacion == 'CAP. SERV.' || $grado_user->grado->abreviacion == 'TTE. SERV.' || $grado_user->grado->abreviacion == 'SBTTE. SERV.') && $clase_personal == 7) {
                $cont;
            }
            if (($grado_user->grado->abreviacion == 'SOF. MTRE.' || $grado_user->grado->abreviacion == 'SOF. MY.' || $grado_user->grado->abreviacion == 'SOF. 1RO.' || $grado_user->grado->abreviacion == 'SOF. 2DO.' || $grado_user->grado->abreviacion == 'SOF. INCL.') && $clase_personal == 8) {
                $cont++;
            }
            if (($grado_user->grado->abreviacion == 'SGTO. 1RO.' || $grado_user->grado->abreviacion == 'SGTO. 2DO.' || $grado_user->grado->abreviacion == 'SGTO. INCL.') && $clase_personal == 9) {
                $cont++;
            }
        }
        if ($user->datosmilitar->escalafon->escalafon == 'EE. CC.') {
            if (($grado_user->grado->abreviacion == 'PROF. V' || $grado_user->grado->abreviacion == 'PROF. IV' || $grado_user->grado->abreviacion == 'PROF. III' || $grado_user->grado->abreviacion == 'PROF. II' || $grado_user->grado->abreviacion == 'PROF. I') && $clase_personal == 10)  {
                $cont++;
            }
            if (($grado_user->grado->abreviacion == 'TÉC. V' || $grado_user->grado->abreviacion == 'TÉC. IV' || $grado_user->grado->abreviacion == 'TÉC. III' || $grado_user->grado->abreviacion == 'TÉC. II' || $grado_user->grado->abreviacion == 'TÉC. I') && $clase_personal == 11) {
                $cont++;
            }
            if (($grado_user->grado->abreviacion == 'ADM. V' || $grado_user->grado->abreviacion == 'ADM. IV' || $grado_user->grado->abreviacion == 'ADM. III' || $grado_user->grado->abreviacion == 'ADM. II' || $grado_user->grado->abreviacion == 'ADM. I') && $clase_personal == 12) {
                $cont++;
            }
            if (($grado_user->grado->abreviacion == 'APAD. V' || $grado_user->grado->abreviacion == 'APAD. IV' || $grado_user->grado->abreviacion == 'APAD. III' || $grado_user->grado->abreviacion == 'APAD. II' || $grado_user->grado->abreviacion == 'APAD. I') && $clase_personal == 13) {
                $cont++;
            }
        }
    }
    return $cont;
}

function verif_novedad($desde, $hasta, $destino_id)//VERIFICA SI YA EXISTE NOVEDAD DEL USUARIO EN LAS FECHAS REQUERIDAS Y EN EL MISMO DESTINO (DEL MISMO USUARIO)
{
    //dd($desde.' desde');
    //dd($hasta.' hasta');
    $destino_novedad = DB::table('destino_novedad')
        ->where([['desde', $desde], ['hasta', $hasta], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON LAS MISMAS FECHAS
        ->orWhere([['desde', $desde], ['hasta', '<', $hasta], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON EL MISMO DESDE DESDE Y UN MAYOR HASTA
        ->orWhere([['desde', '>', $desde], ['hasta', $hasta], ['destino_id', $destino_id]])// EXISTE UNA NOVEDAD CON UN MENOR DESDE Y EL MISMO HASTA
        ->orWhere([['desde', '<', $desde], ['hasta', '>', $desde], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON SU $DESDE ENTRE DESDE Y HASTA
        ->orWhere([['desde', '<', $hasta], ['hasta', '>', $hasta], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON SU $HASTA ENTRE DESDE Y HASTA
        ->orWhere([['hasta', $desde], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON EL $DESDE IGUAL AL HASTA
        ->orWhere([['desde', $hasta], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON EL $HASTA IGUAL AL DESDE
        ->orWhere([['desde', '>', $desde], ['desde', '>', $hasta], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD CON SU $DESDE Y $HASTA ANTERIORES AL DESDE DE OTRA NOVEDAD
        ->orWhere([['desde', '>', $desde], ['hasta', '<', $hasta], ['destino_id', $destino_id]])//EXISTE UNA NOVEDAD ENTRE LAS FECHAS QUE SE QUIERE REGISTRAR
    ->get();
    //dd($destino_novedad);
    return $destino_novedad;
}

function verif_novedad_update($desde, $hasta, $destino_id)//VERIFICA SI YA EXISTE NOVEDAD DEL USUARIO EN LAS FECHAS REQUERIDAS Y EN EL MISMO DESTINO
{
    $verif_novedad = verif_novedad($desde, $hasta, $destino_id);
    if (count($verif_novedad) > 0)//HAY UNA NOVEDAD IGUAL => VERIFICO SI ES DEL MISMO USUARIO 
    {
        return $verif_novedad;//RETORNA UN ARREGLO EN CASO DE HABER COINCIDENCIA
    }
    return 0;//RETORNA 0  EN CASO DE NO HABER COINCIDENCIAS
}