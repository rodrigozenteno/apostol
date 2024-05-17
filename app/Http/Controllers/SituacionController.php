<?php

namespace App\Http\Controllers;

use App\Http\Requests\SituacionRequest;
use App\Models\Situacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SituacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $situacions = Situacion::all();
        return view('apostol.situacions.index', compact('situacions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.situacions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SituacionRequest $request)
    {
        //dd($request->all());
        $situacion = new Situacion($request->all());
        $situacion->save();
        return redirect()->route('situacions.index')->with('info', 'SE REGISTRÓ LA SITUACIÓN CON ÉXITO');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Situacion $situacion)
    {
        //dd($id);
        //$situacion = Situacion::find($id);
        return view('apostol.situacions.edit', compact('situacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Situacion $situacion)
    {
        //$situacion = Situacion::find($id);
        $validator = Validator ::make($request->all(), [
            'situacion' => 'required|max:150|min:7|unique:situacions,situacion,' . $situacion->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('situacions.edit', $situacion->id)
                ->withErrors($validator)
                ->withInput();
        }
        $situacion->fill($request->all());
        $situacion->save();

        return redirect()->route('situacions.index')->with('info', 'SE EDITÓ LA SITUACIÓN CON ÉXITO');
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
}