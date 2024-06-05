<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'q1' => 'required|integer|between:0,3',
            'q2' => 'required|integer|between:0,3',
            'q3' => 'required|integer|between:0,3',
            'q4' => 'required|integer|between:0,3',
            'q5' => 'required|integer|between:0,3',
            'q6' => 'required|integer|between:0,3',
            'q7' => 'required|integer|between:0,3',
            'q8' => 'required|integer|between:0,3',
            'q9' => 'required|integer|between:0,3',
        ]);

        // Calculate the total score
        $totalScore = array_sum($validatedData);

        // Determine the depression severity
        if ($totalScore >= 0 && $totalScore <= 4) {
            $severity = 'Okay';
        } elseif ($totalScore >= 5 && $totalScore <= 9) {
            $severity = 'Mild Depression';
        } elseif ($totalScore >= 10 && $totalScore <= 14) {
            $severity = 'Moderate Depression';
        } elseif ($totalScore >= 15 && $totalScore <= 19) {
            $severity = 'Moderately Severe Depression';
        } else {
            $severity = 'Severe Depression';
        }

        // Return the results with a success message
        return back()->with('success', 'Form submitted successfully!')
                     ->with('totalScore', $totalScore)
                     ->with('severity', $severity);
    }
}
