<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $employee = User::where('email', 'employee@example.com')->first();
        $manager = User::where('email', 'manager@example.com')->first();
        $therapist = User::where('email', 'therapist@example.com')->first();

        $adminRole = Role::where('name', 'Admin')->first();
        $employeeRole = Role::where('name', 'Employee')->first();
        $managerRole = Role::where('name', 'Manager')->first();
        $therapistRole = Role::where('name', 'Therapist')->first();

        
    }
    
}
