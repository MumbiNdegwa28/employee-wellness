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
            return redirect()->route('employee.home');
        } elseif ($user->role_id === 3) {
            return redirect()->route('therapist.home');
        } elseif ($user->role_id === 2) {
            return redirect()->route('manager.home');
        } else {
            return redirect()->route('admin.home');
        }
    }
}
