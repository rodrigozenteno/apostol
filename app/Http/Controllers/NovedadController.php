<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NovedadRequest;
use App\Models\Novedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hola');
        $novedads = Novedad::all();
        return view('apostol.novedads.index', compact('novedads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.novedads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NovedadRequest $request)
    {
        //dd($request->all());
        $novedad = new Novedad($request->all());
        $novedad->save();
        return redirect()->route('novedads.index')->with('info', 'SE REGISTRÓ LA NOVEDAD CON ÉXITO');
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
    public function edit(Novedad $novedad)
    {
        //dd($id);
        //$novedad = Alergia::find($id);
        return view('apostol.novedads.edit', compact('novedad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Novedad $novedad)
    //public function update(Request $request, $id)
    {
        //$novedad = Novedad::find($id);
        $validator = Validator::make($request->all(), [
            'novedad' => 'required|max:150|min:5|unique:novedads,novedad,' . $novedad->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('novedads.edit', $novedad->id)
                ->withErrors($validator)
                ->withInput();
        }
        $novedad->fill($request->all());
        $novedad->save();

        return redirect()->route('novedads.index')->with('info', 'SE EDITÓ LA NOVEDAD CON ÉXITO');
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