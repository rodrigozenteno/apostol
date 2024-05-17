<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplementarioRequest;
use App\Models\Datofamiliar;
use App\Models\DatosComplementario;
use App\Models\Armamento_User;
use App\Models\Destino;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Datocomplementario_UserController extends Controller
{
    public function datos_complementarios($id)
    {
        //dd('VISTA DATOS COMPLEMENTARIOS');
        $user = User::find($id);
        //dd($user);
        $datos_complementarios = DatosComplementario::where('user_id', $user->id)->get();
        //dd($datos_complementarios);
        $datofamiliars = Datofamiliar::where('user_id', $user->id)->get();
        //dd($datofamiliars);
        $armamentos_users = Armamento_User::where('user_id', $user->id)->get();
        //dd($armamentos_users);
        $destino_user = Destino::where('user_id', $user->id)
            ->where('estado', 1)
            ->first();
        return view('apostol.datos.datos_complementarios', compact('user', 'datos_complementarios', 'datofamiliars', 'armamentos_users', 'destino_user'));
    }

    public function create($id)
    {
        $user = User::find($id);
        $user_id = $user->id;
        return view('apostol.datos.create', compact('user_id'));   
    }

    public function store(ComplementarioRequest $request)
    {
        //PRIMERO SE DEBE VERIFICAR SI YA EXISTE UN DATO COMPLEMENTARIO, SI FUERA ASÍ, SE DEBE PONER EN ESTADO 2
        $id = $request->user_id;
        $dato_complementario = DatosComplementario::where('user_id', $id)->where('estado', 1)->get()->last();//SI NO EXISTE REGISTRO => MUESTRA null
        if ($dato_complementario != null)
        {
            //EDITAMOS EL REGISTRO EN ESTADO "ANTERIOR"
            $dato_complementario->estado = 2;
            //dd($dato_complementario);
            $dato_complementario->save();
            ///////////////////////////////////////////
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        $dato_complementario = new DatosComplementario($request->all());
        $dato_complementario->estado = 1;
        $dato_complementario->save();
        return redirect()->route('datos.datos_complementarios', $dato_complementario->user_id);
    }

    public function edit($id)
    {
        //dd('edición de datos complementarios');
        $dato_complementario = DatosComplementario::find($id);
        //dd($dato_complementario);
        return view('apostol.datos.edit', compact('dato_complementario')); 
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $dato_complementario = DatosComplementario::find($id);
        $validator = Validator::make($request->all(), [
            'direccion' => 'required|max:150|min:3',
            'cel' => 'required|max:9|min:8',
            'contacto' => 'required|max:150|min:3',
            'cel_contacto' => 'required|max:9|min:8'
        ]);
        if ($validator->fails()) {
            return redirect()->route('datos.edit', $dato_complementario->id)
                ->withErrors($validator)
                ->withInput();
        }
        $dato_complementario->fill($request->all());
        //dd($dato_complementario);
        $dato_complementario->save();
        return redirect()->route('datos.datos_complementarios', $dato_complementario->user_id);
    }

    public function eliminar($id)
    {
        $dato_complementario = DatosComplementario::find($id);
        $dato_complementario->estado = 2;//SOLO CAMBIA EL ESTADO PARA QUE EXISTA UN HISTORIAL DE SUS DATOS COMPLEMENTARIOS
        $dato_complementario->save();
        return redirect()->route('datos.datos_complementarios', $dato_complementario->user_id);
        //FALTA VER SI SE MUESTRA TODOS LOS REGISTROS, SI EL USUARIO SOLO VE EL REGISTRO ACTUAL, SI VE TODOS,
        //QUE VE EL ADMINISTRADOR, ETC.
    }
}
