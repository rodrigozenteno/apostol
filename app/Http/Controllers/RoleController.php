<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('apostol.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('apostol.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //dd($request->all());
        /////////////////////////////////////////
        //$role = Role::create($request->all());
        ////////////////////////////////////////
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();
        ////////////////////////////////////////
        //$role->permissions()->sync($request->permissions);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.edit', $role)->with('info', 'EL ROL SE CREÓ CON ÉXITO');
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
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('apostol.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:150|min:10|unique:roles,name,' . $role->id,
        ]);
        if ($validator->fails()) {
            return redirect()->route('roles.edit', $role->id)
                ->withErrors($validator)
                ->withInput();
        }
        $role->fill($request->all());
        //dd($role);
        $role->save();
        //$role->permissions()->sync($request->permissions);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.edit', $role)->with('info', 'EL ROL SE EDITÓ CON ÉXITO');
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
