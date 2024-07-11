<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(VideoSeeder::class);

        User::factory()->create([
            'fname' => 'Mumbi',
            'lname' => 'Ndegwa',
            'email' => 'mumbi.ndegwa20@gmail.com',
            'gender' => 'Female',
            'role_id' => 2,
            'DOB' => Carbon::createFromFormat('m/d/Y', '01/09/2004')->format('Y-m-d'),
            'password' => Hash::make('12345678')
        ]);

        User::factory()->create([
            'fname' => 'Sheila',
            'lname' => 'Wachira',
            'email' => 'sheilawamuyu4@gmail.com',
            'gender' => 'Female',
            'role_id' => 1,
            'DOB' => Carbon::createFromFormat('m/d/Y', '03/16/2004')->format('Y-m-d'),
            'password' => Hash::make('12345678')
        ]);
        User::factory()->create([
            'fname' => 'Elvis',
            'lname' => 'Makara',
            'email' => 'elvis.makara@strathmore.edu',
            'gender' => 'Male',
            'role_id' => 4,
            'manager_id' => 1,
            'DOB' => Carbon::createFromFormat('m/d/Y', '09/21/2004')->format('Y-m-d'),
            'password' => Hash::make('12345678')
        ]);
    
    }
}
