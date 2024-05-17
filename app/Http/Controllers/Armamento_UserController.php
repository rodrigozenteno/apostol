<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pistola_UserRequest;
use App\Models\Industria;
use App\Models\Armamento_User;
use App\Models\Situacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Armamento_UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $tipo)
    {
        //dd($id.' '.$tipo);
        $industrias = Industria::all()->pluck('industria', 'id');
        $situacions = Situacion::all()->pluck('situacion', 'id');
        $user_id = $id;
        $anio = Carbon::now()->format('Y');
        //dd($anio);
        return view('apostol.armamentos_users.create', compact('industrias', 'situacions', 'user_id', 'anio', 'tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
            'dotacion' => 'required|numeric',
            'novedades' => 'required',
            'modelo_id' => 'required',
            'situacion_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->serie)
        {
            $validator = Validator::make($request->all(), [
                'serie' => 'required|max:20|min:5|unique:armamento_user,serie',
            ]);
            if ($validator->fails()) {
                return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        if ($request->tipo == 1)//PISTOLA
        {
            $validator = Validator::make($request->all(), [
                'cargador' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        else//CUCHILLO BAYONETA
        {
            $validator = Validator::make($request->all(), [
                'uso' => 'required|max:150|min:5',
                'accesorios' => 'required|max:250|min:5',
            ]);
            if ($validator->fails()) {
                return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $armamento_user = new Armamento_User($request->all());
        $armamento_user->save();
        return redirect()->route('datos.datos_complementarios', $armamento_user->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $armamento_user = Armamento_User::find($id);
        $user_id = $armamento_user->user_id;
        return view('apostol.armamentos_users.show', compact('armamento_user', 'user_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $armamento_user = Armamento_User::find($id);
        //dd($armamento_user);
        $industrias = Industria::all()->pluck('industria', 'id');
        $situacions = Situacion::all()->pluck('situacion', 'id');
        $anio = Carbon::now()->format('Y');
        return view('apostol.armamentos_users.edit', compact('armamento_user', 'industrias', 'situacions', 'anio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $armamento_user = Armamento_User::find($id);
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
            'dotacion' => 'required|numeric',
            'novedades' => 'required',
            'modelo_id' => 'required',
            'situacion_id' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->serie)
        {
            $validator = Validator::make($request->all(), [
                'serie' => 'required|max:15|min:5|unique:armamento_user,serie,' . $armamento_user->id,
            ]);
            if ($validator->fails()) {
                return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        if ($request->tipo == 1)//PISTOLA
        {
            $validator = Validator::make($request->all(), [
                'cargador' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        else//CUCHILLO BAYONETA
        {
            $validator = Validator::make($request->all(), [
                'uso' => 'required|max:150|min:5',
                'accesorios' => 'required|max:250|min:5',
            ]);
            if ($validator->fails()) {
                return redirect()->route('armamentos_users.create', [$request->user_id, $request->tipo])
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $armamento_user->fill($request->all());
        //dd($armamento_user);
        $armamento_user->save();

        return redirect()->route('datos.datos_complementarios', $armamento_user->user_id);
    }
}
