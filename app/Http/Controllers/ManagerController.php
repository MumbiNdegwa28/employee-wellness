<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        return view('manager.home');
    }

    public function evaluationFormReport()
    {
        return view('evaluation-form-report');
    }

    public function planActivities()
    {
        return view('plan-activities');
    }

    public function feedback()
    {
        return view('feedback');
    }
}
