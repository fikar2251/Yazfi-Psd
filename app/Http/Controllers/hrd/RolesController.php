<?php

namespace App\Http\Controllers\hrd;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreRoleRequest, UpdateRoleRequest};
use App\Perusahaan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class RolesController extends Controller
{
    public function index()
    {
        $roles = DB::table('roles')
        ->leftJoin('perusahaans','roles.id_perusahaan','=','perusahaans.id')
        ->select('roles.key','roles.name','perusahaans.nama_perusahaan','roles.id')
        ->orderBy('roles.id','desc')->get();
        return view('hrd.roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role();
        $rolePermissions = null;
        $permissions = Permission::orderBy('Name', 'ASC')->get();

        $perusahaans= Perusahaan::get();

        return view('hrd.roles.create', compact('permissions', 'role', 'rolePermissions','perusahaans'));
    }

    public function store(StoreRoleRequest $request)
    {
        $request['key'] = $request->input('name');
        $request['name'] = \Str::slug($request->input('name'));
        $role = Role::create($request->all());
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('hrd.roles.index')->with('success', 'Role has been added');
    }

    public function show(Role $role)
    {

        $permissions = \DB::table("role_has_permissions")->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where("role_has_permissions.role_id", $role->id)
            ->get();

        return view('hrd.roles.show', compact('role', 'permissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('Name', 'ASC')->get();
        $rolePermissions = DB::table("role_has_permissions")->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where("role_has_permissions.role_id", $role->id)
            ->get();
        $perusahaans = Perusahaan::get();

        return view('hrd.roles.edit', compact('role', 'permissions', 'rolePermissions','perusahaans'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {

        $request['key'] = $request->input('name');
        $request['name'] = \Str::slug($request->input('name'));
        $role->update($request->all());
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('hrd.roles.index')->with('success', 'Role has been updated');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('hrd.roles.index')->with('success', 'Role has been deleted');
    }
}
