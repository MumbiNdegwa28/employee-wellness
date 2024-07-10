<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class ViewUserRecordsController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'fname', 'lname', 'email', 'status')->get();        
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
