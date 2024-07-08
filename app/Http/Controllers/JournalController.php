<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    public function show()
    {
        $journals = Journal::where('user_id', auth()->id())
                      ->orderBy('created_at', 'desc')
                      ->get();
        return view('employee.journaling', compact('journals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required',
        ]);

        Journal::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('journals.show')->with('success', 'Journal entry created successfully!');
    }
}
