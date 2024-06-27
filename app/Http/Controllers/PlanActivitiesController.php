<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlanActivitiesController extends Controller
{
    public function index()
    {
        // Fetch summary of plan activities or any other logic you need
        $summary = []; // Replace with actual data fetching logic

        // Pass data to the view
        return view('manager.plan-activities.summary', compact('summary'));
    }
}
