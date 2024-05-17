<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\Documento;
use App\Models\Documento_User;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Documento_UserController extends Controller
{
    /**
     * Muestra la lista de documentos personales del usuario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //dd('index de documentos personales por usuario');
        $user = User::find($id);
        $documentos = Documento::all();
        $documentos_users = Documento_User::where('user_id', $user->id)->get();
        $grado_nombre_completo = grado_nombre_completo($user->id);
        //dd($documentos_users);
        return view('apostol.documentos_users.index', compact(
            'documentos',
            'documentos_users',
            'grado_nombre_completo',
            'id'
        ));
    }

    public function create($user_id, $doc_id)
    {
        //dd('create documento personal: '.$user_id.', '.$doc_id);
        //dd('ID DEL USUARIO ES: '.$user_id.' ID DEL DOCUMENTO ES: '.$doc_id);
        $documentos = Documento::where('id', $doc_id)->pluck('documento', 'id');
        //dd($documentos);
        $fecha_actual = Carbon::now()->format('Y-m-d');
        return view('apostol.documentos_users.create', compact(
            'user_id',
            'doc_id',
            'documentos',
            'fecha_actual'
        ));
    }

    public function store(FileRequest $request)
    {
        //dd('store de documentos_users');
        //dd(Carbon::now()->format('Y-m-d'));
        $documento_user = New Documento_User($request->all());
        //dd($documento_user);
        //dd($request->file('image'));
        if ($request->file('image'))
        {
            //dd('HAY IMAGEN');
            $file = $request->file('image');
            //dd($file);
            $archivo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            //dd($archivo);
            $path = public_path().'\imagenes\documentos\\';
            //dd($path);
            $documento_user->archivo = $archivo;
            //dd($documento_user);
            if ($file->move($path, $archivo))
            {
                //dd('SE CARGÓ LA IMAGEN, SE REGISTRARÁN LOS DATOS');
                $documento_user->archivo = $archivo;
                $documento_user->save();
                return redirect()->route('documentos_users.index', $documento_user->user_id);
            }
            else
            {
                dd('NO SE CARGÓ LA IMAGEN, NO SE REGISTRARÁN LOS DATOS');
                return redirect()->route('documentos_users.create', [$request->user_id, $request->documento_id])
                ->withInput();
            }
        }
        else
        {
            dd('NO HAY IMAGEN');
        }
    }

    //FUNCIÓN PARA EDITAR UN DOCUMENTO
    public function edit($user_id, $doc_id)
    {
        //dd('EDICIÓN DE DATOS DEL USUARIO: '.$user_id.' DOCUMENTO: '.$doc_id);
        $documento_user = Documento_User::where('user_id', $user_id)->where('documento_id', $doc_id)->first();
        //dd($documento_user);
        $documentos = Documento::where('id', $doc_id)->pluck('documento', 'id');
        //dd($documentos);
        $fecha_actual = Carbon::now()->format('Y-m-d');
        return view('apostol.documentos_users.edit', compact(
            'documentos',
            'fecha_actual',
            'documento_user'
        ));
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
        $documento_user = Documento_User::find($id);
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|',
            'documento_id' => 'required',
            'image' => 'sometimes|required|image|mimes:jpg|max:256'
        ]);
        if ($validator->fails()) {
            return redirect()->route('documentos_users.edit', [$documento_user->id, $documento_user->documento->id])
                ->withErrors($validator)
                ->withInput();
        }
        $nombre_archivo_borrar = $documento_user->archivo;
        $documento_user->fill($request->all());
        if ($request->file('image'))
        {
            //SI HAY IMAGEN => SE DEBE BORRAR LA ANTERIOR Y GUARDAR LA NUEVA
            $file = $request->file('image');
            $archivo = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $path = public_path().'\imagenes\documentos\\';
            $documento_user->archivo = $archivo;
            $pathToFile = public_path( path:"imagenes\documentos\\". $nombre_archivo_borrar);
            if ($file->move($path, $archivo))
            {
                if (unlink($pathToFile)) {
                    //dd('SE CARGÓ LA IMAGEN NUEVA Y SE BORRÓ LA ANTERIOR IMAGEN, SE REGISTRARÁN LOS DATOS);
                    //RETORNA A LA INTERFAZ DE DOCUMENTOS DEL USUARIO
                    $documento_user->save();
                    return redirect()->route('documentos_users.index', $documento_user->user_id);
                }
                else
                {
                    //SE CARGÓ LA IMAGEN PERO NO SE ELIMINÓ LA ANTERIOR IMAGEN
                    //RETORNA A LA INTERFAZ DE EDICIÓN
                    return redirect()->route('documentos_users.edit', [$request->user_id, $request->documento_id])
                    ->withInput();
                }
            }
            else
            {
                //dd('NO SE CARGÓ LA IMAGEN, NO SE REGISTRARÁN LOS DATOS');
                //RETORNA A LA INTERFAZ DE EDICIÓN
                return redirect()->route('documentos_users.edit', [$request->user_id, $request->documento_id])
                ->withInput();
            }
        }
        else//NO SE VA A CAMBIAR LA IMAGEN
        {
            //SE EDITAN LOS DATOS SOLAMENTE
            $documento_user->user_verified = null;
            $documento_user->save();
            return redirect()->route('documentos_users.index', $documento_user->user_id);
        }
    }
    
    //FUNCIÓN PARA VALIDAR UN DOCUMENTO, en la columna user_verified SE REGISTRARÁ EL ID DEL USUARIO QUE VALIDA EL DOCUMENTO
    public function validar($user_id, $doc_id)
    {
        //dd('validación del usuario: '.$user_id.' con el documento: '.$doc_id);
        $documento_user = Documento_User::where('user_id', $user_id)->where('documento_id', $doc_id)->first();
        //dd($documento_user);
        //dd(auth()->id());
        $documento_user->user_verified = auth()->id();
        //dd($documento_user);
        $documento_user->save();
        return redirect()->route('documentos_users.index', $documento_user->user_id);
    }

    //FUNCIÓN PARA VER UN DOCUMENTO
    public function show($user_id, $doc_id)
    {
        $documento_user = Documento_User::where('user_id', $user_id)->where('documento_id', $doc_id)->first();
        $archivo = $documento_user->archivo;
        $pathToFile = public_path( path:"imagenes\documentos\\". $archivo);
        //return response()->download($pathToFile);//DESCARGAR ARCHIVO
        return response()->file($pathToFile);//VER ARCHIVO
    }

     //FUNCIÓN PARA ELIMINAR UN DOCUMENTO
     public function delete($id)
     {
        $documento_user = Documento_User::find($id);
        $archivo = $documento_user->archivo;
        $pathToFile = public_path( path:"imagenes\documentos\\". $archivo);
        if (unlink($pathToFile)) {
            $documento_user->delete();
        }
        return redirect()->route('documentos_users.index', $documento_user->user_id);
     }
}
