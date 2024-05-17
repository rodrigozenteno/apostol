<?php

namespace App\Http\Controllers;

use App\Models\Matbel;
use App\Models\Grado;
use App\Models\User;
use App\Models\Marca;
use App\Models\Industria;
use App\Models\Tipo_armamento;
use App\Models\Situacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MatbelController extends Controller
{
    public function show($id)
    {
        $matbel = Matbel::find($id);
        return view('apostol.matbel.show', compact('matbel'));
    }

    public function index()
    {
        $matbel = Matbel::all();
        //return response()->json($matbel);
        return view('apostol.matbel.index')->with(compact('matbel'));
        
    }

    public function create()

    {
        $grados = Grado::all();
        $users = User::all();
        $marcas = Marca::all();
        $industrias = Industria::all();
        $tipo_armamentos = Tipo_armamento::all();
        $situacions = Situacion::all();
        return view('apostol.matbel.create', compact('grados', 'users', 'marcas', 'industrias', 'tipo_armamentos', 'situacions'));
    }

    public function store(Request $request)
    {
        $matbel = new Matbel;
        $matbel->grado_id = $request->input('grado_id');
        $matbel->user_id = $request->input('user_id');
        $matbel->estado = $request->input('estado');
        $matbel->cel = $request->input('cel');
        $matbel->marca_id = $request->input('marca_id');
        $matbel->marca_id = $request->input('marca_id');
        $matbel->tipo_armamento_id = $request->input('tipo_armamento_id');
        $matbel->situacion_id = $request->input('situacion_id');

        if($request->hasfile('profile_image'))
        {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/matbels/', $filename);
            $matbel->profile_image = $filename;
        }
        $matbel->save();
        return redirect()->back()->with('status','la imagen fue guardada exitosamente');
    }

    public function edit($id)
    {
        $matbel = Matbel::find($id);
        return view('apostol.matbel.edit', compact('matbel'));
    }

    public function update(Request $request, $id)
    {
        $matbel = Matbel::find($id);
        
        $matbel->estado = $request->input('estado');
        $matbel->cel = $request->input('cel');
        if($request->hasfile('profile_image'))
        {
            $destination = 'uploads/matbels/'.$matbel->profile_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/matbels/', $filename);
            $matbel->profile_image = $filename;
        }

        $matbel->update();
        return redirect()->back()->with('status','la imagen fue editada exitosamente');
    }

    public function destroy($id)
    {
        $matbel = Matbel::find($id);
        $destination = 'uploads/matbels/'.$matbel->profile_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $matbel->delete();
        return redirect()->back()->with('eliminar','ok');
    }
}
