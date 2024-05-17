<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('RN PERMISOS');
        $permissions = Permission::all();
        return view('apostol.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('apostol.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission($request->all());
        $permission->guard_name = 'web';
        //dd($permission);
        $permission->save();
        return redirect()->route('permissions.index')->with('info', 'EL PERMISO SE REGISTRÓ CON ÉXITO');  
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
    public function edit(Permission $permission)
    {
        return view('apostol.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|min:9|unique:permissions,name,' . $permission->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('permissions.edit', $permission->id)
                ->withErrors($validator)
                ->withInput();
        }

        $permission->update($request->all());
        $permission->guard_name = 'web';//AUMENTO ESTA LÍNEA POR QUE CASO CONTRARIO GUARDA EL guar_name COMO sanctum
        return redirect()->route('permissions.index')->with('info', 'EL PERMISO SE EDITÓ CON ÉXITO');
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
