<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlergiaRequest;
use App\Models\Alergia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alergias = Alergia::all();
        return view('apostol.alergias.index', compact('alergias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.alergias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlergiaRequest $request)
    {
        $alergia = new Alergia($request->all());
        $alergia->save();
        return redirect()->route('alergias.index')->with('info', 'SE REGISTRÓ LA ALERGIA CON ÉXITO');
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
    public function edit(Alergia $alergia)
    {
        return view('apostol.alergias.edit', compact('alergia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alergia $alergia)
    {
        $validator = Validator::make($request->all(), [
            'alergia' => 'required|max:150|min:3|unique:alergias,alergia,' . $alergia->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('alergias.edit', $alergia->id)
                ->withErrors($validator)
                ->withInput();
        }
        $alergia->fill($request->all());
        $alergia->save();

        return redirect()->route('alergias.index')->with('info', 'SE EDITÓ LA ALERGIA CON ÉXITO');
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
