<?php

namespace App\Http\Controllers;
use App\Models\Escalafon;
use App\Http\Requests\EscalafonRequest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class EscalafonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hola');
        $escalafons = Escalafon::all();
        //dd($escalafons);
        return view('apostol.escalafons.index', compact('escalafons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.escalafons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EscalafonRequest $request)
    {
        //dd($request->all());
        $escalafon = new Escalafon($request->all());
        $escalafon->save();
        return redirect()->route('escalafons.index')->with('info', 'SE REGISTRÓ EL ESCALAFÓN CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Escalafon $escalafon)
    {
        //dd($id);
        //$escalafon = Escalafon::find($id);
        return view('apostol.escalafons.edit', compact('escalafon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escalafon $escalafon)
    {
        //$escalafon = Escalafon::find($id);
        $validator = Validator::make($request->all(), [
            'escalafon' => 'required|max:30|min:5|unique:escalafons,escalafon,' . $escalafon->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('escalafons.edit', $escalafon->id)
                ->withErrors($validator)
                ->withInput();
        }
        $escalafon->fill($request->all());
        $escalafon->save();

        return redirect()->route('escalafons.index')->with('info', 'SE EDITÓ EL ESCALAFÓN CON ÉXITO');
    }
}
