<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanActivitiesController extends Controller
{
    public function index()
    {
        return view('plan-activities.index');
    }
}
