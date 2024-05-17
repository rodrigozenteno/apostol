<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcaRequest;
use App\Models\Industria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::all();
        //dd($marcas);
        return view('apostol.marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $industrias = Industria::all()->pluck('industria', 'id');
        return view('apostol.marcas.create', compact('industrias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarcaRequest $request)
    {
        //dd($request->all());
        $marca = new Marca($request->all());
        $marca->save();
        return redirect()->route('marcas.index')->with('info', 'SE REGISTRÓ LA MARCA CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //$marca = Marca::find($id);
        $industrias = Industria::all()->pluck('industria', 'id');
        return view('apostol.marcas.edit', compact('marca', 'industrias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        //$marca = Marca::find($id);
        $validator = Validator::make($request->all(), [
            'marca' => 'required|max:25|min:5|unique:marcas,marca,' . $marca->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('marcas.edit', $marca->id)
                ->withErrors($validator)
                ->withInput();
        }
        $marca->fill($request->all());
        $marca->save();

        return redirect()->route('marcas.index')->with('info', 'SE EDITÓ LA MARCA CON ÉXITO');
    }

    public function obtener_marcas($id)
    {
        /* $provincias = Provincia::where('departamento_id', $id)->get();
        return $provincias; */
        $marcas = Marca::where('industria_id', $id)->get();
        return $marcas;
    }
}
