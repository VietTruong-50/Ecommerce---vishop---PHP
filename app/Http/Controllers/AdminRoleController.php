<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionParents'));
    }

    public function store(Request $request)
    {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = $this->role->find($id);
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $role->permissions;

        return view('admin.role.edit', compact('permissionParents', 'role', 'permissionChecked'));
    }

    public function update($id, Request $request){
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index');
    }

    public function createPermission(){
        return view('admin.permission.add');
    }
}
