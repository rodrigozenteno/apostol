<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentoRequest;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentos = Documento::all();
        return view('apostol.documentos.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.documentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentoRequest $request)
    {
        //dd($request->all());
        $documento = new Documento($request->all());
        $documento->save();
        return redirect()->route('documentos.index')->with('info', 'SE REGISTRÓ EL TIPO DE DOCUMENTO CON ÉXITO');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //dd($id);
        //$documento = Documento::find($id);
        return view('apostol.documentos.edit', compact('documento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //$documento = Documento::find($id);
        $validator = Validator ::make($request->all(), [
            'documento' => 'required|max:50|min:13|unique:documentos,documento,' . $documento->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('documentos.edit', $documento->id)
                ->withErrors($validator)
                ->withInput();
        }
        $documento->fill($request->all());
        $documento->save();

        return redirect()->route('documentos.index')->with('info', 'SE EDITÓ EL TIPO DE DOCUMENTO CON ÉXITO');
    }
}
