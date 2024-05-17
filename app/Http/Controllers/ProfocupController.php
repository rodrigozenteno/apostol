<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfocupRequest;
use App\Models\Profocup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfocupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profocups = Profocup::all();
        return view('apostol.profocups.index', compact('profocups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.profocups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfocupRequest $request)
    {
        $profocup = new Profocup($request->all());
        //dd($profocup);
        $profocup->save();
        return redirect()->route('profocups.index')->with('info', 'SE REGISTRÓ LA PROFESIÓN/OCUPACIÓN CON ÉXITO');
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
    public function edit(Profocup $profocup)
    {
        //$profocup = Profocup::find($id);
        return view('apostol.profocups.edit', compact('profocup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profocup $profocup)
    {
        //$profocup = Profocup::find($id);
        $validator = Validator::make($request->all(), [
            'profocup' => 'required|max:30|min:3|unique:profocups,profocup,' . $profocup->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('profocups.edit', $profocup->id)
                ->withErrors($validator)
                ->withInput();
        }
        $profocup->fill($request->all());
        $profocup->save();

        return redirect()->route('profocups.index')->with('info', 'SE EDITÓ LA PROFESIÓN/OCUPACIÓN CON ÉXITO');
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
