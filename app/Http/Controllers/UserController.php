<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplementarioRequest;
use App\Http\Requests\FileRequest;
use App\Http\Requests\UserRequest;
use App\Models\Alergia;
use App\Models\Arma;
use App\Models\Arma_User;
use App\Models\Carnet;
use App\Models\DatosComplementario;
use App\Models\Datosmilitar;
use App\Models\Departamento;
use App\Models\Diplomado;
use App\Models\Diplomado_User;
use App\Models\Documento;
use App\Models\Documento_User;
use App\Models\Escalafon;
use App\Models\Escalafon_User;
use App\Models\Especialidad;
use App\Models\Especialidad_User;
use App\Models\Estado;
use App\Models\Estado_User;
use App\Models\Grado;
use App\Models\Grado_User;
use App\Models\Municipio;
use App\Models\Municipio_User;
use App\Models\Profocup;
use App\Models\Profocup_User;
use App\Models\Seguro;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        /* dd('ACÁ LLEGA DIRECTAMENTE DESPUES DE LOGUEARSE'); */
        //CONSULTA PARA OBTENER A LOS USUARIOS ORDENADOS POR:
        //ESCALAFÓN DE ARMAS
        //GRADO
        //FECHA DE ALTA
        //ANTIGUEDAD
        //OBTENIENDO UN ARREGLO CON LOS ID DE LOS USUARIOS EN ESE ORDEN
        $users = DB::table('users')
        ->join('datosmilitars', 'users.id', '=', 'datosmilitars.user_id')
            ->where('datosmilitars.escalafon_id', 1)
            ->orderBy('datosmilitars.escalafon_id', 'asc')
            ->orderBy('datosmilitars.grado_id', 'asc')
            ->orderBy('users.f_alt', 'asc')
            ->orderBy('users.ant', 'asc')
        ->select('users.id')
        ->pluck('id');
        //dd($users);
        $band = 1;
        return view('apostol.users.index', compact('users', 'band'));
    }

    public function index_servicios()
    {
        //CONSULTA PARA OBTENER A LOS USUARIOS ORDENADOS POR:
        //ESCALAFÓN DE SERVICIOS
        //GRADO
        //FECHA DE ALTA
        //ANTIGUEDAD
        //OBTENIENDO UN ARREGLO CON LOS ID DE LOS USUARIOS EN ESE ORDEN
        $users = DB::table('users')
        ->join('datosmilitars', 'users.id', '=', 'datosmilitars.user_id')
            ->where('datosmilitars.escalafon_id', 2)
            ->orderBy('datosmilitars.escalafon_id', 'asc')
            ->orderBy('datosmilitars.grado_id', 'asc')
            ->orderBy('users.f_alt', 'asc')
            ->orderBy('users.ant', 'asc')
        ->select('users.id')
        ->pluck('id');
        $band = 2;
        return view('apostol.users.index', compact('users', 'band'));
        
    }

    public function index_eecc()
    {
        //CONSULTA PARA OBTENER A LOS USUARIOS ORDENADOS POR:
        //ESCALAFÓN DE EE.CC.
        //GRADO
        //FECHA DE ALTA
        //ANTIGUEDAD
        //OBTENIENDO UN ARREGLO CON LOS ID DE LOS USUARIOS EN ESE ORDEN
        $users = DB::table('users')
        ->join('datosmilitars', 'users.id', '=', 'datosmilitars.user_id')
            ->where('datosmilitars.escalafon_id', 3)
            ->orderBy('datosmilitars.escalafon_id', 'asc')
            ->orderBy('datosmilitars.grado_id', 'asc')
            ->orderBy('users.f_alt', 'asc')
            ->orderBy('users.ant', 'asc')
        ->select('users.id')
        ->pluck('id');
        $band = 3;
        return view('apostol.users.index', compact('users', 'band'));
    }

    public function index_ant()
    {
        //CONSULTA PARA OBTENER A LOS USUARIOS ORDENADOS POR:
        //ESCALAFONES (1RO. ARMAS, 2DO. SERVICIOS Y 3RO. EE.CC.)
        //GRADO
        //FECHA DE ALTA
        //ANTIGUEDAD
        //OBTENIENDO UN ARREGLO CON LOS ID DE LOS USUARIOS EN ESE ORDEN
        $users = DB::table('users')
        ->join('datosmilitars', 'users.id', '=', 'datosmilitars.user_id')
            ->orderBy('datosmilitars.escalafon_id', 'asc')
            ->orderBy('datosmilitars.grado_id', 'asc')
            ->orderBy('users.f_alt', 'asc')
            ->orderBy('users.ant', 'asc')
        ->select('users.id')
        ->pluck('id');
        $band = 4;
        return view('apostol.users.index', compact('users', 'band'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // FUNCIÓN PARA REGISTRAR USUARIOS
        // RECIBE UN PARAMETRO: 1 SI SE REGISTRARÁ PERSONAL DE ARMAS
        //2 SI SE REGISTRARÁ PERSONAL DE SERVICIOS
        //3 SI SE REGISTRARÁ PERSONAL CIVIL
        if ($id == 1)
        {
            $estados = Estado::all()->pluck('estado', 'id');
            $especialidads = Especialidad::all()->pluck('especialidad', 'id');
            $diplomados = Diplomado::all()->pluck('diplomado', 'id');
            $grados = Grado::where('escalafon_id', 1)->pluck('grado', 'id');
            $armas = Arma::all()->pluck('arma', 'id');
            $alergias = Alergia::all()->pluck('alergia', 'id');
            $seguros = Seguro::all()->pluck('seguro', 'id');
            $escalafons = Escalafon::where('id', $id)->pluck('escalafon', 'id');
            $departamentos = Departamento::all()->pluck('departamento', 'id');
            $municipios = Municipio::all()->pluck('municipio', 'id');
            return view('apostol.users.create', compact(
                'estados',
                'especialidads',
                'diplomados',
                'grados',
                'armas',
                'alergias',
                'seguros',
                'escalafons',
                'departamentos',
                'municipios'
            ));
        }
        if ($id == 2)
        {
            $estados = Estado::all()->pluck('estado', 'id');
            $diplomados = Diplomado::all()->pluck('diplomado', 'id');
            $grados = Grado::where('escalafon_id', 2)->pluck('grado', 'id');
            $alergias = Alergia::all()->pluck('alergia', 'id');
            $seguros = Seguro::all()->pluck('seguro', 'id');
            $escalafons = Escalafon::where('id', $id)->pluck('escalafon', 'id');
            $departamentos = Departamento::all()->pluck('departamento', 'id');
            $municipios = Municipio::all()->pluck('municipio', 'id');
            return view('apostol.users.create_servicios', compact(
                'estados',
                'diplomados',
                'grados',
                'alergias',
                'seguros',
                'escalafons',
                'departamentos',
                'municipios'
            ));
        }
        if ($id == 3)
        {
            $estados = Estado::all()->pluck('estado', 'id');
            $profocups = Profocup::all()->pluck('profocup', 'id');
            $diplomados = Diplomado::all()->pluck('diplomado', 'id');
            $grados = Grado::where('escalafon_id', 3)->pluck('grado', 'id');
            $alergias = Alergia::all()->pluck('alergia', 'id');
            $seguros = Seguro::all()->pluck('seguro', 'id');
            $escalafons = Escalafon::where('id', $id)->pluck('escalafon', 'id');
            $departamentos = Departamento::all()->pluck('departamento', 'id');
            $municipios = Municipio::all()->pluck('municipio', 'id');
            return view('apostol.users.create_eecc', compact(
                'estados',
                'profocups',
                'diplomados',
                'grados',
                'alergias',
                'seguros',
                'escalafons',
                'departamentos',
                'municipios'
            ));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //REGISTRA PERSONAL DE ARMAS
        $user = new User($request->all());
        $user->password = bcrypt($request->prim_apellido.'_'.$request->ci);
        if ($request->seg_nombre == null)
        {
            $user->seg_nombre = '';
        }
        if ($request->seg_apellido == null)
        {
            $user->seg_apellido = '';
        }
        $user->save();
        $user->alergias()->sync($request->alergias);

        $carnet = new Carnet($request->all());
        $carnet->user()->associate($user);
        $carnet->save();

        $municipio_user = new Municipio_User($request->all());
        $municipio_user->user()->associate($user);
        $municipio_user->save();

        $datosmilitar = new Datosmilitar($request->all());
        $datosmilitar->user()->associate($user);
        $datosmilitar->save();

        return redirect()->route('users.index');
    }

    public function store_eecc(Request $request)
    {
        //REGISTRA PERSONAL DE EMPLEADOS CIVILES
        $user = new User($request->all());
        
        $user->password = bcrypt($request->prim_apellido.'_'.$request->ci);
        if ($request->seg_nombre == null)
        {
            $user->seg_nombre = '';
        }
        if ($request->seg_apellido == null)
        {
            $user->seg_apellido = '';
        }
        $user->save();
        $user->alergias()->sync($request->alergias);

        $carnet = new Carnet($request->all());
        $carnet->user()->associate($user);
        $carnet->save();

        $municipio_user = new Municipio_User($request->all());
        $municipio_user->user()->associate($user);
        $municipio_user->save();

        $datosmilitar = new Datosmilitar($request->all());
        $datosmilitar->user()->associate($user);
        $datosmilitar->save();

        return redirect()->route('users.index_eecc');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $estados = Estado::all()->pluck('estado', 'id');
        $especialidads = Especialidad::all()->pluck('especialidad', 'id');
        $diplomados = Diplomado::all()->pluck('diplomado', 'id');
        $armas = Arma::all()->pluck('arma', 'id');
        $profocups = Profocup::all()->pluck('profocup', 'id');
        $alergias = alergias($user->id);
        $seguros = Seguro::all()->pluck('seguro', 'id');
        $escalafons = Escalafon::all()->pluck('escalafon', 'id');
        if ($user->escalafon_user->escalafon_id == 1)//ARMAS
        {
            $grados = Grado::where('escalafon_id', 1)->pluck('grado', 'id');
        }
        if ($user->escalafon_user->escalafon_id == 2)//EE.CC
        {
            $grados = Grado::where('escalafon_id', 2)->pluck('grado', 'id');
        }
        if ($user->escalafon_user->escalafon_id == 3)//SERVICIOS
        {
            $grados = Grado::where('escalafon_id', 3)->pluck('grado', 'id');
        }
        return view('apostol.users.show', compact(
            'user',
            'estados',
            'especialidads',
            'diplomados',
            'grados',
            'profocups',
            'armas',
            'alergias',
            'seguros',
            'escalafons'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /* ESTA FUNCIÓN ES PARA EDITAR LOS DATOS DE UN REGISTRO EXISTENTE, NO PARA CAMBIARLOS POR:
         ASCENSO,
         CAMBIO DE ARMA,
         CAMBIO DE DIPLOMADO,
        CAMBIO DE ESCALAFÓN,
        ETC.*/
        $escalafon_id = $user->datosmilitar->escalafon->id;
        if ($escalafon_id == 1)//ARMAS
        {
            $estados = Estado::all()->pluck('estado', 'id');
            $especialidads = Especialidad::all()->pluck('especialidad', 'id');
            $diplomados = Diplomado::all()->pluck('diplomado', 'id');
            $grados = Grado::where('escalafon_id', 1)->pluck('grado', 'id');
            $armas = Arma::all()->pluck('arma', 'id');
            $alergias = Alergia::all()->pluck('alergia', 'id');
            $seguros = Seguro::all()->pluck('seguro', 'id');
            $escalafons = Escalafon::where('id', 1)->pluck('escalafon', 'id');
            $departamentos = Departamento::all()->pluck('departamento', 'id');
            $municipios = Municipio::all()->pluck('municipio', 'id');
            return view('apostol.users.edit', compact(
                'user',
                'escalafon_id',
                'estados',
                'especialidads',
                'diplomados',
                'grados',
                'armas',
                'alergias',
                'seguros',
                'escalafons',
                'departamentos',
                'municipios'
            ));
        }
        if ($escalafon_id == 3)//EE.CC
        {
            $estados = Estado::all()->pluck('estado', 'id');
            $profocups = Profocup::all()->pluck('profocup', 'id');
            $diplomados = Diplomado::all()->pluck('diplomado', 'id');
            $grados = Grado::where('escalafon_id', 3)->pluck('grado', 'id');
            $alergias = Alergia::all()->pluck('alergia', 'id');
            $seguros = Seguro::all()->pluck('seguro', 'id');
            $escalafons = Escalafon::where('id', 3)->pluck('escalafon', 'id');
            $departamentos = Departamento::all()->pluck('departamento', 'id');
            $municipios = Municipio::all()->pluck('municipio', 'id');
            return view('apostol.users.edit', compact(
                'user',
                'escalafon_id',
                'estados',
                'profocups',
                'diplomados',
                'grados',
                'alergias',
                'seguros',
                'escalafons',
                'departamentos',
                'municipios'
            ));
        }
        if ($escalafon_id == 2)//SERVICIOS
        {
            $estados = Estado::all()->pluck('estado', 'id');
            $profocups = Profocup::all()->pluck('profocup', 'id');
            $diplomados = Diplomado::all()->pluck('diplomado', 'id');
            $grados = Grado::where('escalafon_id', 2)->pluck('grado', 'id');
            $alergias = Alergia::all()->pluck('alergia', 'id');
            $seguros = Seguro::all()->pluck('seguro', 'id');
            $escalafons = Escalafon::where('id', 2)->pluck('escalafon', 'id');
            dd($escalafons);
            $departamentos = Departamento::all()->pluck('departamento', 'id');
            $municipios = Municipio::all()->pluck('municipio', 'id');
            return view('apostol.users.edit', compact(
                'user',
                'escalafon_id',
                'estados',
                'profocups',
                'diplomados',
                'grados',
                'alergias',
                'seguros',
                'escalafons',
                'departamentos',
                'municipios'
            ));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request->all());
        /* ESTA FUNCIÓN ES PARA EDITAR LOS DATOS DE UN REGISTRO EXISTENTE, NO PARA CAMBIARLOS POR ASCENSO,
        CAMBIO DE ESCALAFÓN, CAMBIO DE ESTADO CIVIL, ETC.*/
        $carnet = Carnet::find($user->carnet->id);
        $validator = Validator::make($request->all(), [
            'estado_id' => 'required',
            'escalafon_id' => 'required',
            'ci' => 'required|max:10|min:7|unique:users,ci,' . $user->id,
            'c_militar' => 'required|max:10|min:6|unique:carnets,c_militar,' . $carnet->id,
            'seguro_id' => 'required',
            'c_seguro' => 'required|max:15|min:9|unique:carnets,c_seguro,' . $carnet->id,
            'papeleta' => 'required|min:7|unique:users,papeleta,' . $user->id,
            'grado_id' => 'required',
            'prim_nombre' => 'required|max:30|min:3',
            'prim_apellido' => 'required|max:30|min:3',
            'f_nac' => 'required',
            'departamento_id' => 'required',
            'provincia_id' => 'required',
            'municipio_id' => 'required',
            'e_civil' => 'required',
            'sexo' => 'required',
            'g_sang' => 'required',
            'email' => 'required|max:255|min:11|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.edit', $user->id)
                ->withErrors($validator)
                ->withInput();
        }
        if ($user->datosmilitar->escalafon->id == 1)//ESCALAFÓN DE ARMAS
        {
            //dd('validator de armas');
            $validator = Validator::make($request->all(), [
                'arma_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('users.edit', $user->id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        else//NO ES ESCALAFÓN DE ARMAS
        {
            //dd('validator de servicios y ee.cc.');
            $validator = Validator::make($request->all(), [
                'profocup_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('users.edit', $user->id)
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        
        $user->fill($request->all());
        if ($request->seg_nombre == null)
        {
            $user->seg_nombre = '';
        }
        if ($request->seg_apellido == null)
        {
            $user->seg_apellido = '';
        }
        $user->save();
        $user->alergias()->sync($request->alergias);//SINCRONIZACIÓN DE ALERGIAS, REGISTRO DE LAS ALERGIAS DEL REGISTRADO, SE SOBRE ESCRIBEN
        $carnet->fill($request->all());
        $carnet->save();

        $municipio_user = $user->municipio_user;
        $municipio_user->fill($request->all());
        $municipio_user->save();

        $datosmilitar = $user->datosmilitar;
        $datosmilitar->fill($request->all());
        $datosmilitar->save();

        return redirect()->route('datos.datos_complementarios', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    public function asignar_roles(User $user)
    {
        //dd($user->getPermissionNames());
        $roles = Role::all();
        return view('apostol.users.edit_roles', compact('roles', 'user'));
    }

    public function store_roles(Request $request)
    {
        $user = User::find($request->user_id);
        $user->roles()->sync($request->roles);
        return redirect()->route('users.edit_roles', $user)->with('info', 'LOS ROLES DEL USUARIO SE ASIGNARON CON ÉXITO');
    }

    public function edit_roles(User $user)
    {
        $roles = Role::all();
        return view('apostol.users.edit_roles', compact('roles', 'user'));
    }

    public function update_roles(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('users.edit_roles', $user)->with('info', 'LOS ROLES DEL USUARIO SE EDITARON CON ÉXITO');        
    }
}