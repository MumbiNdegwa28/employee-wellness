<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

use Illuminate\Http\Request;

class ManageUserPermissionsController extends Controller
{
    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $request->validate([
            'roles' => 'array|nullable',
            'permissions' => 'array|nullable',
        ]);

        // Sync roles and permissions
        $user->roles()->sync($request->input('roles', []));
        $user->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.users.show', $user)->with('success', 'User permissions updated successfully.');
    }
}
