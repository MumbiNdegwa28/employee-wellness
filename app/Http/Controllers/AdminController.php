<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.home');
    }

    /**
     * Display the user records.
     *
     * @return \Illuminate\View\View
     */
    public function viewUserRecords()
    {
        // Fetch user records logic here
        return view('admin.view-user-records');
    }

    public function edit(User $user)
    {
        $roles = Role::all(); // Assuming you have a Role model to fetch roles from the database
        return view('admin.manageUserPermissions.edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, User $user)
    {
        $user->update($request->only('name', 'email'));

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    public function logins()
    {
        $users = User::all();
        $loginCount = User::whereNotNull('last_login_at')->count();

        return view('admin.users.logins', compact('users', 'loginCount'));
    }
    /**
     * Display the manage user permissions page.
     *
     * @return \Illuminate\View\View
     */
    public function manageUserPermissions()
    {
        // Fetch user permissions logic here
        return view('admin.manage-user-permissions');
    }
}
