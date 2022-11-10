<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $roleIds = $request->role_ids;
            $user->roles()->attach($roleIds);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return 'Error';
        }
    }

    public function edit($id)
    {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $rolesOfUser = $user->roles;
        return view('admin.user.edit', compact('user', 'roles', 'rolesOfUser'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $user =$this->user->find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $roleIds = $request->role_ids;
            $user->roles()->sync($roleIds);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return 'Error';
        }
    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $this->user->find($id)->delete();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
