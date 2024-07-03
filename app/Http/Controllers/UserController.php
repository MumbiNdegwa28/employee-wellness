<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.manageuserpermissions.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string|in:male,female,rather not say',
            'permissions' => 'array',
        ]);

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->dob = $request->dob;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = bcrypt('password'); // Set a default password or handle password creation separately

        $user->save();
        $user->permissions()->sync($request->permissions);

        return redirect()->route('admin.manageUserPermissions.create')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all(); // Assuming you have a Permission model

        return view('admin.manageUserPermissions.edit', compact('user', 'permissions'));
    }
    public function updatePermissions(Request $request, User $user)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'permissions' => 'array',
        ]);
        $user->update([
            $user->fname = $request->fname,
            $user->lname = $request->lname,
            $user->email = $request->email,       
        ]);
        $user->permissions()->sync($request->permissions);
        $user->save();
        return redirect()->route('admin.manageUserPermissions.index')->with('success', 'Permissions updated successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
