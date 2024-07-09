<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Routing\Controller as BaseController; // Add this impor
class RoleManagementController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:manager');
    }

    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.role-management.index', compact('users', 'roles'));
    }
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        if ($user && $role) {
            $user->roles()->syncWithoutDetaching([$role->id]);
            return redirect()->back()->with('message', 'Role assigned successfully.');
        }

        return redirect()->back()->with('error', 'User or role not found.');
    }
}
