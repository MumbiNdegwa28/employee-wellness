<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\PasswordValidationRules;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'DOB' => ['required', 'date'],
            'gender' => ['required', 'string', 'max:255'],
        ])->validate();

        $role = Role::where('fname', 'default_role_name')->first();
        $role = Role::where('lname', 'default_role_name')->first();

        return User::create([
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'DOB' => $input['DOB'],
            'gender' => $input['gender'],
            'role_id' => $role->id,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
