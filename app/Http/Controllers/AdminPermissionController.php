<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function store(Request $request){
        $permission = Permission::create([
           'name' => $request->module_parent,
           'display_name' => $request->module_parent,
           'parent_id' => 0,
        ]);

        foreach ($request->module_child as $moduleChildItem){
            Permission::create([
                'name' => $moduleChildItem,
                'display_name' => $moduleChildItem,
                'parent_id' => $permission->id,
                'key_code' => $moduleChildItem . '_' .  $request->module_parent
            ]);
        }

        return redirect()->route('permissions.create');
    }
}
