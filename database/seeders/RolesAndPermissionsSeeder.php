<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create roles
         //$managerRole = Role::create(['name' => 'manager']);
         //$employeeRole = Role::create(['name' => 'employee']);
 
         // Create permissions
         //$editArticlesPermission = Permission::create(['name' => 'edit articles']);
         //$deleteArticlesPermission = Permission::create(['name' => 'delete articles']);
 
         // Assign permissions to roles
         //$managerRole->givePermissionTo($editArticlesPermission);
         //$managerRole->givePermissionTo($deleteArticlesPermission);

         // Assign roles to a user
         //$user = User::find(1); // Change this to the appropriate user ID
         //if ($user) {
           //  $user->assignRole($managerRole);
         //}

    }
}
