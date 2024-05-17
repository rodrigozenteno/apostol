<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbicacionRequest;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hola');
        $ubicacions = Ubicacion::all();
        return view('apostol.ubicacions.index', compact('ubicacions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.ubicacions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UbicacionRequest $request)
    {
        //dd($request->all());
        $ubicacion = new Ubicacion($request->all());
        $ubicacion->save();
        return redirect()->route('ubicacions.index');
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
    public function edit(Ubicacion $ubicacion)
    {
        //dd($id);
        //$alergia = Ubicacion::find($id);
        return view('apostol.ubicacions.edit', compact('ubicacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacion)
    //public function update(Request $request, $id)
    {
        //$ubicacion = Ubicacion::find($id);
        $validator = Validator::make($request->all(), [
            'ubicacion' => 'required|max:15|min:5|unique:ubicacions,ubicacion,' . $ubicacion->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('ubicacions.edit', $ubicacion->id)
                ->withErrors($validator)
                ->withInput();
        }
        $ubicacion->fill($request->all());
        $ubicacion->save();

        return redirect()->route('ubicacions.index');
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
