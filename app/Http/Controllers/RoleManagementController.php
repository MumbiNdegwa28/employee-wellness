<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleManagementController extends Controller
{
    public function index()
    {
        $users = User::all(); //fetch all users
        $roles = Role::whereIn('role_name', ['Manager', 'Therapist'])->get();

        return view('admin.role-management.index', compact('users', 'roles'));
    }
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $roleId = $request->role_id;

        $user->assignRole($roleId);

        return redirect()->back()->with('message', 'Role assigned successfully.');
    }
    public function suspendUser(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    $user = User::find($request->user_id);
    $user->status = 'suspended';
    $user->save();

    return redirect()->back()->with('message', 'User suspended successfully.');
}
    public function setupRolesAndPermissions()
    {
        // Create roles
        $managerRole = Role::create(['name' => 'manager']);
        $therapistRole = Role::create(['name' => 'therapist']);

        // Create permissions
        //$editArticlesPermission = Permission::create(['name' => 'edit articles']);
        //$deleteArticlesPermission = Permission::create(['name' => 'delete articles']);

        // Assign permissions to roles
        //$managerRole->givePermissionTo($editArticlesPermission);
        //$managerRole->givePermissionTo($deleteArticlesPermission);

        // Assign roles to a user
        $user = User::find(2); // Change this to the appropriate user ID
        if ($user) {
            $user->assignRole($managerRole);
        }
        $user = User::find(3); // Change this to the appropriate user ID
        if ($user) {
            $user->assignRole($therapistRole);
        }

        return 'Roles and permissions setup completed';
}
}
