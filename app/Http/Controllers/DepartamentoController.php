<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoRequest;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::all();
        return view('apostol.departamentos.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.departamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {
        $departamento = new Departamento($request->all());
        $departamento->save();
        return redirect()->route('departamentos.index')->with('info', 'SE REGISTRÓ EL DEPARTAMENTO CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //dd($id);
        //$departamento = Departamento::find($id);
        return view('apostol.departamentos.edit', compact('departamento'));
    }

    public function update(Request $request, Departamento $departamento)
    {
        //$departamento = Departamento::find($id);
        $validator = Validator::make($request->all(), [
            'departamento' => 'required|max:150|min:3|unique:departamentos,departamento,' . $departamento->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('departamentos.edit', $departamento->id)
                ->withErrors($validator)
                ->withInput();
        }
        $departamento->fill($request->all());
        $departamento->save();

        return redirect()->route('departamentos.index')->with('info', 'SE EDITÓ EL DEPARTAMENTO CON ÉXITO');
    }
}
