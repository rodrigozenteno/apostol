<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestinoRequest;
use App\Models\Destino;
use App\Models\Unidad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DestinoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $user_id = $user->id;
        $unidads = Unidad::all()->pluck('unidad', 'id');
        return view('apostol.destinos.create', compact('user_id', 'unidads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinoRequest $request)
    {
        $destino = new Destino($request->all());
        $destino->f_ini = Carbon::now()->toDateTimeString();
        $destino->estado = 1;
        $destino->save();
        return redirect()->route('datos.datos_complementarios', $destino->user_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Destino $destino)
    {
        $unidads = Unidad::all()->pluck('unidad', 'id');
        return view('apostol.destinos.edit', compact('destino', 'unidads'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_destinados($id)
    {
        //RESUELTO, PERO SOLO DA LA UNIDAD CONSIDERADA, NO ASÍ DE SUS UU. DD.
        $unidad = Unidad::find($id);
        $nombre_unidad = $unidad->unidad;
        //INDEX QUERY ORDENADO POR ESCALAFONES Y ANTIGUEDAD
        $destinados = destinados($id);
        return view('apostol.destinos.index_query', compact('destinados', 'nombre_unidad'));
    }

    public function index_destinados_uu_dd($id)
    {        
        /* PARA LA U CONSIDERADA Y UU. SUBALTERNAS */
        $unidad = Unidad::find($id);//UNIDAD CONSIDERADA
        $uu_dd = $unidad->subalternas;
        //dd($unidad);
        //dd($uu_dd);
        return view('apostol.destinos.index', compact('unidad', 'uu_dd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destino $destino)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'unidad_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('destinos.edit', $destino->id)
                ->withErrors($validator)
                ->withInput();
        }
        $destino->fill($request->all());
        $destino->save();
        return redirect()->route('datos.datos_complementarios', $destino->user_id);
    }

    public function cambiar_destino(Destino $destino)
    {
        //dd($destino);
        $unidads = Unidad::all();
        $unidads = $unidads->except($destino->unidad_id)->pluck('unidad', 'id');
        //dd($unidads);
        return view('apostol.destinos.cambiar_destino', compact('destino', 'unidads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_cambio(Request $request)
    {
        //dd($request->all());
        $destino_ant = Destino::find($request->destino_id);
        $destino_ant->estado = 2;
        $destino_ant->f_fin = Carbon::now()->toDateTimeString();
        //dd($destino_ant);
        $destino_ant->save();
        $destino = new Destino();
        $destino->user_id = $destino_ant->user_id;
        $destino->unidad_id = $request->unidad_id;
        $destino->f_ini = Carbon::now()->toDateTimeString();
        $destino->estado = 1;
        //dd($destino);
        $destino->save();
        return redirect()->route('datos.datos_complementarios', $destino->user_id);
    }
}
