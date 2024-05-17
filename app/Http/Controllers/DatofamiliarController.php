<?php

namespace App\Http\Controllers;

use App\Http\Requests\DatofamiliarRequest;
use App\Models\Datofamiliar;
use App\Models\Relacion;
use App\Models\Seguro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DatofamiliarController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $relacions = Relacion::all()->pluck('relacion', 'id');
        $seguros = Seguro::all()->pluck('seguro', 'id');
        $user_id = $id;
        return view('apostol.datofamiliars.create', compact('relacions', 'seguros', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DatofamiliarRequest $request)
    {
        //dd($request->all());
        $datofamiliar = new Datofamiliar($request->all());
        //dd($datofamiliar);
        $datofamiliar->save();
        return redirect()->route('datos.datos_complementarios', $datofamiliar->user_id);
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
    public function edit($id)
    {
        //dd($id);
        $datofamiliar = Datofamiliar::find($id);
        $relacions = Relacion::all()->pluck('relacion', 'id');
        $seguros = Seguro::all()->pluck('seguro', 'id');
        return view('apostol.datofamiliars.edit', compact('datofamiliar', 'relacions', 'seguros'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datofamiliar = Datofamiliar::find($id);
        $validator = Validator::make($request->all(), [
            'datofamiliar' => 'required|max:150|min:3|unique:datofamiliars,datofamiliar,' . $datofamiliar->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('datofamiliars.edit', $datofamiliar->id)
                ->withErrors($validator)
                ->withInput();
        }
        $datofamiliar->fill($request->all());
        $datofamiliar->save();

        return redirect()->route('datofamiliars.index');
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
