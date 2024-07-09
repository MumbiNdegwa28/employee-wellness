<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('employee')) {
            return redirect()->route('employee.dashboard');
        } elseif ($user->hasRole('manager')) {
            return redirect()->route('manager.dashboard');
        } elseif ($user->hasRole('therapist')) {
            return redirect()->route('therapist.dashboard');
        }

        abort(403, 'Unauthorized');
    }

    public function admin()
    {
        return view('dashboards.admin');
    }

    public function employee()
    {
        return view('dashboards.employee');
    }

    public function manager()
    {
        return view('dashboards.manager');
    }

    public function therapist()
    {
        return view('dashboards.therapist');
    }
}
