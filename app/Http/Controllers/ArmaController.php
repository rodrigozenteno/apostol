<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArmaRequest;
use Illuminate\Http\Request;
use App\Models\Arma;
use Illuminate\Support\Facades\Validator;

class ArmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $armas = Arma::all();
        return view('apostol.armas.index', compact('armas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.armas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArmaRequest $request)
    {
        $arma = new Arma($request->all());
        $arma->save();
        return redirect()->route('armas.index')->with('info', 'SE REGISTRÓ EL ARMA CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Arma $arma)
    {
        //$arma = Arma::find($id);
        return view('apostol.armas.edit', compact('arma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arma $arma)
    {
        //$arma = Arma::find($id);
        $validator = Validator::make($request->all(), [
            'arma' => 'required|max:30|min:4|unique:armas,arma,'. $arma->id,
            'abreviacion' => 'required|max:10|min:4|unique:armas,abreviacion,'. $arma->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('armas.edit', $arma->id)
                ->withErrors($validator)
                ->withInput();
        }
        $arma->fill($request->all());
        $arma->save();

        return redirect()->route('armas.index')->with('info', 'SE EDITÓ EL ARMA CON ÉXITO');
    }
}
