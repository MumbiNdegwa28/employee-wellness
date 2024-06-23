<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'DOB' => '1990-01-01',
                'email' => 'johndoe@example.com',
                'gender' => 'male',
                'role_id' => 1,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
            [
                'fname' => 'Jane',
                'lname' => 'Doe',
                'DOB' => '1992-02-02',
                'email' => 'janedoe@example.com',
                'gender' => 'female',
                'role_id' => 2,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password123'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
            // Add more user records as needed
            [
                'fname' => 'Sheila',
                'lname' => 'Wamuyu',
                'DOB' => '1992-02-02',
                'email' => 'sheilawamuyu4@gmail.com',
                'gender' => 'female',
                'role_id' => 2,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => Str::random(10),
                'current_team_id' => null,
                'profile_photo_path' => null,
            ],
            
        ]);
    }
}
