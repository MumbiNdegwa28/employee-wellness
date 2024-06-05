<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role_id === 4) {
            return view('employee.home');
        } elseif ($user->role_id ==- '3') {
            return view('therapist.home');
        } elseif ($user->role_id === '2') {
            return view('manager.home');
        } else {
            return view('admin.home');
        }
    }
}
