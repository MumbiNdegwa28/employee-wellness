<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planner;

class PlannerController extends Controller
{
    public function index()
    {
        // Fetch all planner events
        //$events = Planner::all()->map(function ($event) {
          //  return [
           //     'title' => $event->title,
           //     'start' => $event->start_date->format('Y-m-d H:i:s'),
         //       'end' => $event->end_date ? $event->end_date->format('Y-m-d H:i:s') : null,
          //      'description' => $event->description,
           // ];
       // });
        $events = Planner::all();
        //return view('planner.index', compact('events'));
        return view('therapist.planner',['events' => $events]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        //Planner::create($request->all());
        Planner::create($validatedData);
        return redirect()->route('therapist.planner')->with('success', 'Appointment scheduled successfully.');
    }
}