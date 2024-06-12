<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planner;

class PlannerController extends Controller
{
    public function index()
    {
        return view('therapist.planner');
    }
    public function store(Request $request)
    {
        return Planner::create($request->all());
    }
}