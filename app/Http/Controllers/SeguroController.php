<?php

namespace App\Http\Controllers;
use App\Models\Seguro;
use Illuminate\Http\Request;
use App\Http\Requests\SeguroRequest;
use Illuminate\Support\Facades\Validator;

class SeguroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguros = Seguro::all();
        return view('apostol.seguros.index', compact('seguros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.seguros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SeguroRequest $request)
    {
        $seguro = new Seguro($request->all());
        $seguro->save();
        return redirect()->route('seguros.index')->with('info', 'SE REGISTRÓ EL SEGURO CON ÉXITO');
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
    public function edit(Seguro $seguro)
    {
        //$seguro = Seguro::find($id);
        return view('apostol.seguros.edit', compact('seguro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguro $seguro)
    {
        //$seguro = Seguro::find($id);
        $validator = Validator::make($request->all(), [
            'seguro' => 'required|max:150|min:10|unique:seguros,seguro,' . $seguro->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('seguros.edit', $seguro->id)
                ->withErrors($validator)
                ->withInput();
        }
        $seguro->fill($request->all());
        $seguro->save();

        return redirect()->route('seguros.index')->with('info', 'SE EDITÓ EL SEGURO CON ÉXITO');
    }
}
