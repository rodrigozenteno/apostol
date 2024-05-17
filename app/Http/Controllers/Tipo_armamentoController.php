<?php

namespace App\Http\Controllers;
use App\Models\Tipo_armamento;

use Illuminate\Http\Request;

class Tipo_armamentoController extends Controller
{
    public function index()
    {
        $tipo_armamento = Tipo_armamento::all();
        //return response()->json($matbel);
        return view('apostol.tipo_armamento.index')->with(compact('tipo_armamento'));
        
    }
    public function create()

    {
        return view('apostol.tipo_armamento.create');
    }

    public function store(Request $request)
    {
        $tipo_armamento = new Tipo_armamento;
        $tipo_armamento->nombre = $request->input('nombre');     
        $tipo_armamento->save();
        return redirect()->back()->with('status','el tipo fue guardado exitosamente');
    }
    public function edit($id)
    {
        $tipo_armamento = Tipo_armamento::find($id);
        return view('apostol.tipo_armamento.edit', compact('tipo_armamento'));
    }

    public function update(Request $request, $id)
    {
        $tipo_armamento = Tipo_armamento::find($id);
        $tipo_armamento->nombre = $request->input('nombre');
    
       

        $tipo_armamento->update();
        return redirect()->back()->with('editar','ok');
    }

    public function destroy($id)
    {
        $tipo_armamento = Tipo_armamento::find($id);
        
       
        $tipo_armamento->delete();
        return redirect()->back()->with('eliminar','ok');
    }

}
