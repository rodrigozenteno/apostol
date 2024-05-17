<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidad;
use App\Http\Requests\EspecialidadRequest;
use Illuminate\Support\Facades\Validator;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidads = Especialidad::all();
        return view('apostol.especialidads.index', compact('especialidads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.especialidads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecialidadRequest $request)
    {
        $estado = new Especialidad($request->all());
        $estado->save();
        return redirect()->route('especialidads.index')->with('info', 'SE REGISTRÓ LA ESPECIALIDAD CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Especialidad $especialidad)
    {
        //dd($id);
        //$especialidad = Especialidad::find($id);
        return view('apostol.especialidads.edit', compact('especialidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Especialidad $especialidad)
    {
        //$especialidad = Especialidad::find($id);
        //dd($especialidad);
        $validator = Validator::make($request->all(), [
            'especialidad' => 'required|max:35|min:8|unique:especialidads,especialidad,'. $especialidad->id,
            'abreviacion' => 'required|max:25|min:4|unique:especialidads,abreviacion,'. $especialidad->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('especialidads.edit', $especialidad->id)
                ->withErrors($validator)
                ->withInput();
        }
        $especialidad->fill($request->all());
        $especialidad->save();

        return redirect()->route('especialidads.index')->with('info', 'SE EDITÓ LA ESPECIALIDAD CON ÉXITO');
    }
}
