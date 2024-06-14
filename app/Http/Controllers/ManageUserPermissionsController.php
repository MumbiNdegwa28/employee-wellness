<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class ManageUserPermissionsController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        return view('admin.manageUserPermissions.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

         // Load the user's current permissions
        $user->load('permissions');
        return view('admin.manageUserPermissions.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'permissions' => 'array|nullable',
        ]);

         // Update user details
         $user->name = $request->name;
         $user->email = $request->email;
         $user->save();

        // Sync roles and permissions
        $user->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.manageUserPermissions.index')->with('success', 'User permissions updated successfully.');
    }
}
