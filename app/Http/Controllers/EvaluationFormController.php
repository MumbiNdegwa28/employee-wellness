<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationForm;

class EvaluationFormController extends Controller
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

        // Store the form submission in the database
        EvaluationForm::create([
            'q1' => $validatedData['q1'],
            'q2' => $validatedData['q2'],
            'q3' => $validatedData['q3'],
            'q4' => $validatedData['q4'],
            'q5' => $validatedData['q5'],
            'q6' => $validatedData['q6'],
            'q7' => $validatedData['q7'],
            'q8' => $validatedData['q8'],
            'q9' => $validatedData['q9'],
            'total_score' => $totalScore,
            'severity' => $severity,
        ]);

        // Return the results with a success message
        return back()->with('success', 'Form submitted successfully!')
                     ->with('totalScore', $totalScore)
                     ->with('severity', $severity);
    }

    public function showReport()
    {
        $evaluationForms = EvaluationForm::all();
        return view('evaluation-report', compact('evaluationForms'));
    }
}
