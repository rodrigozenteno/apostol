<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelacionRequest;
use App\Models\Relacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RelacionController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relacions = Relacion::all();
        return view('apostol.relacions.index', compact('relacions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.relacions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelacionRequest $request)
    {
        //dd($request->all());
        $relacion = new Relacion($request->all());
        $relacion->save();
        return redirect()->route('relacions.index')->with('info', 'SE REGISTRÓ LA RELACIÓN CON ÉXITO');
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
    public function edit(Relacion $relacion)
    {
        //dd($id);
        //$relacion = Relacion::find($id);
        return view('apostol.relacions.edit', compact('relacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relacion $relacion)
    {
        //$relacion = Relacion::find($id);
        $validator = Validator::make($request->all(), [
            'relacion' => 'required|max:15|min:3|unique:relacions,relacion,' . $relacion->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('relacions.edit', $relacion->id)
                ->withErrors($validator)
                ->withInput();
        }
        $relacion->fill($request->all());
        $relacion->save();

        return redirect()->route('relacions.index')->with('info', 'SE EDITÓ LA RELACIÓN CON ÉXITO');
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
