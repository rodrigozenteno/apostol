<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinciaRequest;
use App\Models\Departamento;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::all();
        return view('apostol.provincias.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all()->pluck('departamento', 'id');
        return view('apostol.provincias.create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinciaRequest $request)
    {
        $provincia = new Provincia($request->all());
        $provincia->save();
        return redirect()->route('provincias.index')->with('info', 'SE REGISTRÓ LA PROVINCIA CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Provincia $provincia)
    {
        //$provincia = Provincia::find($id);
        $departamentos = Departamento::all()->pluck('departamento', 'id');
        return view('apostol.provincias.edit', compact('provincia', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provincia $provincia)
    {
        //$provincia = Provincia::find($id);
        $validator = Validator::make($request->all(), [
            'provincia' => 'required|max:25|min:4',
        ]);
        if ($validator->fails()) {
            return redirect()->route('provincias.edit', $provincia->id)
                ->withErrors($validator)
                ->withInput();
        }
        $provincia->fill($request->all());
        $provincia->save();

        return redirect()->route('provincias.index')->with('info', 'SE EDITÓ LA PROVINCIA CON ÉXITO');
    }

    public function obtener_provincias($id)
    {
        //dd($id);
        $provincias = Provincia::where('departamento_id', $id)->get();
        //dd($provincias);
        return $provincias;
    }
}
