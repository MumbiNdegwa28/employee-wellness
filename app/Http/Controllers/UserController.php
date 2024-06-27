<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all(); // Assuming you have a Permission model

        return view('admin.manageUserPermissions.edit', compact('user', 'permissions'));
    }
    public function updatePermissions(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'permissions' => 'array',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->permissions()->sync($request->permissions);
        return redirect()->route('admin.manageUserPermissions.index')->with('success', 'Permissions updated successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
