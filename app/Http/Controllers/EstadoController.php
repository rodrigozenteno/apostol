<?php

namespace App\Http\Controllers;
use App\Models\Estado;
use App\Http\Requests\EstadoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::all();
        //dd($estados->id);
        return view('apostol.estados.index', compact('estados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.estados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoRequest $request)
    {
        //dd($request->all());
        $estado = new Estado($request->all());
        $estado->save();
        return redirect()->route('estados.index')->with('info', 'SE REGISTRÓ EL ESTADO CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //dd($id);
        //$estado = Estado::find($id);
        return view('apostol.estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        //$estado = Estado::find($id);
        $validator = Validator::make($request->all(), [
            'estado' => 'required|max:50|min:3|unique:estados,estado,' . $estado->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('estados.edit', $estado->id)
                ->withErrors($validator)
                ->withInput();
        }
        $estado->fill($request->all());
        $estado->save();

        return redirect()->route('estados.index')->with('info', 'SE EDITÓ EL ESTADO CON ÉXITO');
    }
}
