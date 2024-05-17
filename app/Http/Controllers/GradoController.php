<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradoRequest;
use App\Models\Escalafon;
use App\Models\Grado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grados = Grado::all();
        return view('apostol.grados.index', compact('grados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escalafons = Escalafon::all()->pluck('escalafon', 'id');
        return view('apostol.grados.create', compact('escalafons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradoRequest $request)
    {
        $grado = new Grado($request->all());
        //dd($grado);
        $grado->save();
        return redirect()->route('grados.index')->with('info', 'SE REGISTRÓ EL GRADO CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Grado $grado)
    {
        //$grado = Grado::find($id);
        $escalafons = Escalafon::all()->pluck('escalafon', 'id');
        return view('apostol.grados.edit', compact('grado', 'escalafons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grado $grado)
    {
        //$grado = Grado::find($id);
        $validator = Validator::make($request->all(), [
            'grado' => 'required|max:25|min:7|unique:grados,grado,'. $grado->id,
            'abreviacion' => 'required|max:15|min:3|unique:grados,abreviacion,'. $grado->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('grados.edit', $grado->id)
                ->withErrors($validator)
                ->withInput();
        }
        $grado->fill($request->all());
        $grado->save();

        return redirect()->route('grados.index')->with('info', 'SE EDITÓ EL GRADO CON ÉXITO');
    }
}
