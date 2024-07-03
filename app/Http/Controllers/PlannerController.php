<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planner;

class PlannerController extends Controller
{
    public function index()
    {
        // Example of passing events data to the view
        $events = [
            ['title' => 'Event 1', 'start' => '2023-07-01'],
            ['title' => 'Event 2', 'start' => '2023-07-02']
        ];
        // dd($events);
        return view('therapist.planner',compact('events'));
    }
    public function store(Request $request)
    {
        return Planner::create($request->all());
    }
}