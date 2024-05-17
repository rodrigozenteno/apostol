<?php

namespace App\Http\Controllers;

use App\Http\Requests\MunicipioRequest;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = Municipio::all();
        return view('apostol.municipios.index', compact('municipios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all()->pluck('departamento', 'id');
        $provincias = Provincia::all()->pluck('provincia', 'id');
        return view('apostol.municipios.create', compact('departamentos', 'provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MunicipioRequest $request)
    {
        $municipio = new Municipio($request->all());
        //dd($municipio);
        $municipio->save();
        return redirect()->route('municipios.index')->with('info', 'SE REGISTRÓ EL MUNICIPIO CON ÉXITO');
    }

    public function edit(Municipio $municipio)
    {
        //dd('edit municipios');
        $departamentos = Departamento::all()->pluck('departamento', 'id');
        $provincias = Provincia::all()->pluck('provincia', 'id');
        //$municipio = Municipio::find($id);
        return view('apostol.municipios.edit', compact('departamentos', 'provincias', 'municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipio $municipio)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'departamento_id' => 'required',
            'provincia_id' => 'required',
            'municipio' => 'required|max:25|min:5',
        ]);
        if ($validator->fails()) {
            return redirect()->route('municipios.edit', $municipio->id)
                ->withErrors($validator)
                ->withInput();
        }
        $municipio->fill($request->all());
        //BUSQUEDA SI EXISTE OTRO REGISTRO IGUAL => >< id, = municipio, = provincia_id, = departamento_id
        $otro_muni = Municipio::where('id', '<>', $municipio->id)->where('municipio', $municipio->municipio)->where('provincia_id', $municipio->provincia_id)->get();
        if (count($otro_muni) > 0)
        {
            //dd($otro_muni);
            return redirect()->route('municipios.edit', $municipio->id)->withInput();
        }
        //dd('NO HAY OTRO MUNICIPIO IGUAL EN LA MISMA PROVINCIA');
        $municipio->save();

        return redirect()->route('municipios.index')->with('info', 'SE EDITÓ EL MUNICIPIO CON ÉXITO');
    }

    public function obtener_municipios($id)
    {
        //dd('hola');
        return $municipios = Municipio::where('provincia_id', $id)->get();
    }
}
