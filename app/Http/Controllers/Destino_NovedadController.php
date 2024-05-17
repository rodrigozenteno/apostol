<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Destino_NovedadRequest;
use App\Models\Destino_Novedad;
use App\Models\Novedad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Destino_NovedadController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //SE DEBE VERIFICAR SI NO EXISTE YA UNA NOVEDAD REGISTRADA QUE CONSIDERE LA FECHA DE HOY
        
        ////////////////////////////////////////////////////////////////////////////////////////
        $destino = destino($id);
        $desde = substr(Carbon::now()->toDateTimeString(),0,10);
        $novedads = Novedad::all()->pluck('novedad', 'id');
        return view('apostol.destinos_novedads.create', compact('destino', 'novedads', 'desde'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Destino_NovedadRequest $request)
    {
        //dd($request->all());
        $destino_novedad = new Destino_Novedad($request->all());
        //dd($destino_novedad);
        $verif_novedad = verif_novedad($destino_novedad->desde, $destino_novedad->hasta, $destino_novedad->destino_id);
        if (count($verif_novedad) > 0) {
            return redirect()->route('destinos.index_destinados', $request->unidad_id);
        }
        $destino_novedad->save();
        return redirect()->route('destinos.index_destinados', $request->unidad_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destino_novedad = Destino_Novedad::find($id);
        $novedads = Novedad::all()->pluck('novedad', 'id');
        return view('apostol.destinos_novedads.show', compact('destino_novedad', 'novedads'));
    }

    public function eliminar(Destino_Novedad $destino_novedad)
    {
        //dd($destino_novedad);
        $novedads = Novedad::all()->pluck('novedad', 'id');
        return view('apostol.destinos_novedads.eliminar', compact('destino_novedad', 'novedads'));
        //dd($destino_novedad);
    }

    public function destroy(Request $request)
    {
        $destino_novedad = Destino_Novedad::find($request->destino_novedad_id);
        $unidad_id = $destino_novedad->destino->unidad_id;
        $destino_novedad->delete();
        return redirect()->route('destinos.index_destinados', $unidad_id);
    }
}
