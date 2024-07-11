<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
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
