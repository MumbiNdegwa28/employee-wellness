<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Models\Permission;
// use Illuminate\Http\Request;
// use App\Models\User;
use App\Models\User;
use App\Models\Role;
use App\Mail\UserWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Actions\Fortify\PasswordValidationRules;

class UserController extends Controller
// {
//     public function create()
//     {
//         $permissions = Permission::all();
//         return view('admin.manageuserpermissions.create', compact('permissions'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'fname' => 'required|string|max:255',
//             'lname' => 'required|string|max:255',
//             'dob' => 'required|date',
//             'email' => 'required|string|email|max:255|unique:users',
//             'gender' => 'required|string|in:male,female,rather not say',
//             'permissions' => 'array',
//         ]);

//         $user = new User();
//         $user->fname = $request->fname;
//         $user->lname = $request->lname;
//         $user->dob = $request->dob;
//         $user->email = $request->email;
//         $user->gender = $request->gender;
//         $user->password = bcrypt('password'); // Set a default password or handle password creation separately

//         $user->save();
//         $user->permissions()->sync($request->permissions);

//         return redirect()->route('admin.manageUserPermissions.create')->with('success', 'User created successfully.');
//     }
//     public function edit($id)
//     {
//         $user = User::findOrFail($id);
//         $permissions = Permission::all(); // Assuming you have a Permission model

//         return view('admin.manageUserPermissions.edit', compact('user', 'permissions'));
//     }
//     public function updatePermissions(Request $request, User $user)
//     {
//         $request->validate([
//             'fname' => 'required|string|max:255',
//             'lname' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255',
//             'permissions' => 'array',
//         ]);
//         $user->update([
//             $user->fname = $request->fname,
//             $user->lname = $request->lname,
//             $user->email = $request->email,       
//         ]);
//         $user->permissions()->sync($request->permissions);
//         $user->save();
//         return redirect()->route('admin.manageUserPermissions.index')->with('success', 'Permissions updated successfully');
//     }
//     public function destroy(User $user)
//     {
//         $user->delete();
//         return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
//     }
// }
{

    use PasswordValidationRules;

    public function index()
    {
        //fetch all non-tenant users
        $adminRole = Role::where('role_name', 'Admin')->first();
        $users = User::where('role_id', '!=', $adminRole->id)->with('role')->paginate(5);

        return view('admin.users-index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users-create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role_id' => ['required', 'exists:roles,id']
        ]);

        // // Sanitize phone number
        // $phoneNumber = preg_replace('/\D/', '', $request->phone_number); // Remove all non-numeric characters
        // if (substr($phoneNumber, 0, 1) === '0') {
        //     $phoneNumber = '254' . substr($phoneNumber, 1);
        // } elseif (substr($phoneNumber, 0, 3) !== '254') {
        //     $phoneNumber = '254' . $phoneNumber;
        // }


        //Store the password
        $password = $request->password;
        $role_id = $request->role_id;

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        //Retrieve the role
        $role = Role::find($role_id);
        $roleName = $role ? $role->role_name : 'Undefined Role';

        //Send email to new user
        Mail::to($user->email)->send(new UserWelcome($user, $password, $roleName));

        return redirect()->route('admin.user.index')->with('success', 'User added successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users-edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => ['required', 'exists:roles,id']
        ]);

        // // Sanitize phone number
        // $phoneNumber = preg_replace('/\D/', '', $request->phone_number); // Remove all non-numeric characters
        // if (substr($phoneNumber, 0, 1) === '0') {
        //     $phoneNumber = '254' . substr($phoneNumber, 1);
        // }

        // 'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],

        //Update the user
        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully');
    }

    
    public function suspend(User $user)
    {
        $user->suspended = true;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User suspended successfully');
    }

    public function unsuspend(User $user)
    {
        $user->suspended = false;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User unsuspended successfully');
    }
}
