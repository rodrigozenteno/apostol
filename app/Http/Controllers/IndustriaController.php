<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndustriaRequest;
use App\Models\Industria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $industrias = Industria::all();
        return view('apostol.industrias.index', compact('industrias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.industrias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndustriaRequest $request)
    {
        //dd($request->all());
        $industria = new Industria($request->all());
        $industria->save();
        return redirect()->route('industrias.index')->with('info', 'SE REGISTRÓ LA INDUSTRIA CON ÉXITO');
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
    public function edit(Industria $industria)
    {
        //dd($id);
        //$industria = Industria::find($id);
        return view('apostol.industrias.edit', compact('industria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Industria $industria)
    {
        //$industria = Industria::find($id);
        $validator = Validator::make($request->all(), [
            'industria' => 'required|max:50|min:4|unique:industrias,industria,' . $industria->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('industrias.edit', $industria->id)
                ->withErrors($validator)
                ->withInput();
        }
        $industria->fill($request->all());
        $industria->save();

        return redirect()->route('industrias.index')->with('info', 'SE EDITÓ LA INDUSTRIA CON ÉXITO');
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
