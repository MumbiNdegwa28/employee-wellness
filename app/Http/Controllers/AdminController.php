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
    //mumbi addditions 
    public function index()
    {
        $roles = Role::all();
        return view('admin.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        Role::create($request->all());

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function editRole(Role $role)
    {
        return view('admin.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        $role->update($request->all());

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

}

