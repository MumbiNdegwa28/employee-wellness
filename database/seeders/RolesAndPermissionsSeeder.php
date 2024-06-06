<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_users',
            'edit_users',
            'delete_users',
            'create_users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'admin',
            'editor',
            'viewer',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
