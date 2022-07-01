<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get roles with their permisisons
        $roles = Role::with('permissions')->get();

        return view('pages.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('pages.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payloads = $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:roles,slug'],
        ]);

        $payloads['is_default'] = $request->has('is_default');

        $role = Role::create($payloads);
        
        // set is_default of another role to false
        if ($payloads['is_default']) {
            $role->removeDefaultOfAnotherRole();
        }

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions, false);
        }

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // all permission
        $permissions = Permission::all();

        return view(
            'pages.roles.edit',
            [
                'role'                  => $role,
                'permissions'           => $permissions
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $payloads = $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:roles,slug,' . $role->id],
        ]);

        $payloads['is_default'] = $request->has('is_default');

         // set is_default of another role to false
        if ($payloads['is_default']) {
            $role->removeDefaultOfAnotherRole();
        }

        $role->update($payloads);

        // sync permisisons of this role
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
