<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RangoRequest;
use App\Http\Requests\UnidadRequest;
use App\Models\Departamento;
use App\Models\Grado_User;
use App\Models\Municipio;
use App\Models\Novedad;
use App\Models\Provincia;
use App\Models\Tipo;
use App\Models\Ubicacion;
use App\Models\Unidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hola');
        $unidads = Unidad::all();
        return view('apostol.unidads.index', compact('unidads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::all()->pluck('tipo', 'id');
        $unidads = Unidad::all()->pluck('unidad', 'id');
        $ubicacions = Ubicacion::all()->pluck('ubicacion', 'id');
        $departamentos = Departamento::all()->pluck('departamento', 'id');
        return view('apostol.unidads.create', compact('tipos', 'unidads', 'ubicacions', 'departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadRequest $request)
    {
        //dd($request->all());
        $ubicacion = new Unidad($request->all());
        $ubicacion->save();
        return redirect()->route('unidads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unidad $unidad)
    {
        return view('apostol.unidads.show', compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidad $unidad)
    {
        $tipos = Tipo::all()->pluck('tipo', 'id');
        $unidads = Unidad::all()->pluck('unidad', 'id');
        $unidads = $unidads->except($unidad->id);
        $ubicacions = Ubicacion::all()->pluck('ubicacion', 'id');
        $departamentos = Departamento::all()->pluck('departamento', 'id');
        return view('apostol.unidads.edit', compact('unidad', 'unidads', 'tipos', 'ubicacions', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidad $unidad)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'unidad' => 'required|max:100|min:5|unique:unidads,unidad,' . $unidad->id,
            'abrev' => 'required|max:50|unique:unidads,abrev,' . $unidad->id,
            'municipio_id' => 'required',
            'ubicacion_id' => 'required',
            'tipo_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('unidads.edit', $unidad->id)
                ->withErrors($validator)
                ->withInput();
        }
        $unidad->fill($request->all());
        //dd($unidad);
        $unidad->save();

        return redirect()->route('unidads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function novedads(Unidad $unidad)/*NOVEDADES VIGENTES DE UNA UNIDAD $id*/
    {
        $hoy = substr(Carbon::now()->toDateTimeString(),0,10);//FECHA ACTUAL
        //NOVEDADES DEL DÍA DE HOY PARA EL DESTINO SELECCIONADO
        $destino_novedad = destino_novedad($unidad, $hoy);
        ////////////////////////////////////////////////////////////////////////
        $novedads = Novedad::all();
        //PERSONAL DESTINADO EN EL DESTINO SELECCIONADO, ORDENADO POR ANTIGUEDAD
        $destinados = destinados($unidad->id);
        ////////////////////////////////////////////////////////////////////////////////
        //////////////OBTENER EFECTIVOS (ARMAS, MÚSICA, SERVICIOS, EE.CC.)
        $armas_sup = efectivos_personal($unidad->id, 1);
        $armas_sub = efectivos_personal($unidad->id, 2);
        $armas_sofs = efectivos_personal($unidad->id, 3);
        $armas_sgtos = efectivos_personal($unidad->id, 4);
        $mus_sofs = efectivos_personal($unidad->id, 5);
        $mus_sgtos = efectivos_personal($unidad->id, 6);
        $serv_oo = efectivos_personal($unidad->id, 7);
        $serv_sofs = efectivos_personal($unidad->id, 8);
        $serv_sgtos = efectivos_personal($unidad->id, 9);
        $ee_cc_prof = efectivos_personal($unidad->id, 10);
        $ee_cc_tec = efectivos_personal($unidad->id, 11);
        $ee_cc_adm = efectivos_personal($unidad->id, 12);
        $ee_cc_apad = efectivos_personal($unidad->id, 13);
        ////////////////////////////////////////////////////////////////////////////////
        $efectivo = count($destinados);
        return view('apostol.novedads.novedads_unidad', compact(
        'destino_novedad',
        'novedads',
        'hoy',
        'unidad',
        'efectivo',
        'armas_sup',
        'armas_sub',
        'armas_sofs',
        'armas_sgtos',
        'mus_sofs',
        'mus_sgtos', 
        'serv_oo',
        'serv_sofs',
        'serv_sgtos',
        'ee_cc_prof',
        'ee_cc_tec',
        'ee_cc_adm',
        'ee_cc_apad'));
    }

    public function novedads_uu_dd(Unidad $unidad)/*NOVEDADES VIGENTES DE UNA UNIDAD $id*/
    {
        $hoy = substr(Carbon::now()->toDateTimeString(),0,10);//FECHA ACTUAL
        $uu_dd = $unidad->subalternas;
        //NOVEDADES DEL DÍA DE HOY PARA EL DESTINO SELECCIONADO
        /* $destino_novedad = destino_novedad($unidad, $hoy); */
        ////////////////////////////////////////////////////////////////////////
        $novedads = Novedad::all();
        //PERSONAL DESTINADO EN EL DESTINO SELECCIONADO, ORDENADO POR ANTIGUEDAD
        /* $destinados = destinados($unidad->id); */
        ////////////////////////////////////////////////////////////////////////////////
        return view('apostol.novedads.novedads_unidad_uu_dd', compact(
        'novedads',
        'hoy',
        'unidad',
        'uu_dd'));
    }

    public function novedads_fechas(Unidad $unidad)
    {
        return view('apostol.novedads.novedads_unidad_fechas_form', compact('unidad'));
    }

    public function rango(RangoRequest $request)/*NOVEDADES VIGENTES EN UN RANGO DE FECHAS $id*/
    {
        $unidad = Unidad::find($request->unidad_id);
        $desde = $request->desde;
        $hasta = $request->hasta;
        $destino_novedad = DB::table('destino_novedad')
            ->join('destinos', 'destino_novedad.destino_id', '=', 'destinos.id')
                ->where([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','>', $desde],['destino_novedad.desde','=', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','>', $desde],['destino_novedad.desde','<', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','>', $desde],['destino_novedad.hasta','=', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','>', $desde],['destino_novedad.hasta','<', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','=', $desde],['destino_novedad.desde','=', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','=', $desde],['destino_novedad.hasta','>', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','=', $desde],['destino_novedad.hasta','=', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','=', $desde],['destino_novedad.hasta','<', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.desde','<', $desde],['destino_novedad.hasta','>', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.hasta','>', $desde],['destino_novedad.hasta','=', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.hasta','>', $desde],['destino_novedad.hasta','<', $hasta]])
                ->orWhere([['destinos.unidad_id', $unidad->id],['destino_novedad.hasta','=', $desde]])
        ->select('destinos.user_id','destino_novedad.novedad_id', 'destino_novedad.id', 'destino_novedad.desde', 'destino_novedad.hasta', 'destino_novedad.obs')
        ->get();
        $novedads = Novedad::all();
        return view('apostol.novedads.novedads_unidad_fechas_result', compact('destino_novedad', 'novedads', 'unidad', 'desde', 'hasta'));
    }
}