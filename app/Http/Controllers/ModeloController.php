<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModeloRequest;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::all();
        //dd($modelos);
        return view('apostol.modelos.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::all()->pluck('marca', 'id');
        return view('apostol.modelos.create', compact('marcas'));
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
            'modelo' => 'required|max:50|min:2|unique:modelos,modelo',
            'marca_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('modelos.create')
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->calibre)
        {
            $validator = Validator::make($request->all(), [
                'calibre' => 'required|max:25|min:3',
            ]);
            if ($validator->fails()) {
                return redirect()->route('modelos.create')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $modelo = new Modelo($request->all());
        $modelo->save();
        return redirect()->route('modelos.index')->with('info', 'SE REGISTRÓ EL MODELO CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        //$modelo = Modelo::find($id);
        $marcas = Marca::all()->pluck('marca', 'id');
        return view('apostol.modelos.edit', compact('modelo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modelo $modelo)
    {
        //dd($request->all());
        //$modelo = Modelo::find($id);
        //dd($modelo);
        $validator = Validator::make($request->all(), [
            'modelo' => 'required|max:50|min:2|unique:modelos,modelo,' . $modelo->id,
            'marca_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('modelos.edit', $modelo->id)
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->calibre)
        {
            $validator = Validator::make($request->all(), [
                'calibre' => 'required|max:25|min:3',
            ]);
            if ($validator->fails()) {
                return redirect()->route('modelos.edit', $modelo->id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $modelo->fill($request->all());
        //dd($modelo);
        $modelo->save();

        return redirect()->route('modelos.index')->with('info', 'SE EDITÓ EL MODELO CON ÉXITO');
    }

    public function obtener_modelos($id)
    {
        /* $provincias = Provincia::where('departamento_id', $id)->get();
        return $provincias; */
        $modelos = Modelo::where('marca_id', $id)->get();
        return $modelos;
    }
}