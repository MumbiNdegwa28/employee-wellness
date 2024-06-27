<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('manager.plan-activities.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Activity::create($request->all());

        return redirect()->route('activities.index');
    }
    public function showActivities()
{
    // Fetch the activities from the database or any other source
    $activities = Activity::all(); // Assuming you have an Activity model

    // Pass the activities to the view
    return view('manager.plan-activities.index', compact('activities'));
}

}
