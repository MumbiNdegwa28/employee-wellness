<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleManagementController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.role-management.index', compact('users', 'roles'));
    }
    public function setupRolesAndPermissions()
    {
        // Create roles
        $managerRole = Role::create(['name' => 'manager']);
        $employeeRole = Role::create(['name' => 'employee']);

        // Create permissions
        $editArticlesPermission = Permission::create(['name' => 'edit articles']);
        $deleteArticlesPermission = Permission::create(['name' => 'delete articles']);

        // Assign permissions to roles
        $managerRole->givePermissionTo($editArticlesPermission);
        $managerRole->givePermissionTo($deleteArticlesPermission);

        // Assign roles to a user
        $user = User::find(1); // Change this to the appropriate user ID
        if ($user) {
            $user->assignRole($managerRole);
        }

        return 'Roles and permissions setup completed';
}
}
