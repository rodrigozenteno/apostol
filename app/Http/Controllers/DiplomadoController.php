<?php

namespace App\Http\Controllers;

use App\Models\Diplomado;
use App\Http\Requests\DiplomadoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiplomadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diplomados = Diplomado::all();
        return view('apostol.diplomados.index', compact('diplomados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.diplomados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiplomadoRequest $request)
    {
        $estado = new Diplomado($request->all());
        $estado->save();
        return redirect()->route('diplomados.index')->with('info', 'SE REGISTRÓ EL DIPLOMADO CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Diplomado $diplomado)
    {
        //$diplomado = Diplomado::find($id);
        return view('apostol.diplomados.edit', compact('diplomado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diplomado $diplomado)
    {
        //$diplomado = Diplomado::find($id);
        $validator = Validator::make($request->all(), [
            'diplomado' => 'required|max:150|min:6|unique:diplomados,diplomado,'. $diplomado->id,
            'abreviacion' => 'required|max:15|min:3|unique:diplomados,abreviacion,'. $diplomado->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('diplomados.edit', $diplomado->id)
                ->withErrors($validator)
                ->withInput();
        }
        $diplomado->fill($request->all());
        $diplomado->save();

        return redirect()->route('diplomados.index')->with('info', 'SE EDITÓ EL DIPLOMADO CON ÉXITO');
    }
}
