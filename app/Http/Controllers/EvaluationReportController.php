<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationForm;
use App\Models\User;

class EvaluationReportController extends Controller
{
    public function index()
    {
        $evaluationData = EvaluationForm::all();

        $data = $evaluationData->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        })->map(function ($group) {
            return [
                'date' => $group->first()->created_at->format('Y-m-d'),
                'minimal' => $group->where('severity', 'Minimal depression')->count(),
                'mild' => $group->where('severity', 'Mild depression')->count(),
                'moderate' => $group->where('severity', 'Moderate depression')->count(),
                'moderately_severe' => $group->where('severity', 'Moderately severe depression')->count(),
                'severe' => $group->where('severity', 'Severe depression')->count(),
            ];
        })->values();

        // $genderData = User::with('evaluationForms')
        //     ->get()
        //     ->groupBy('gender')
        //     ->map(function ($group) {
        //         return [
        //             'minimal' => $group->pluck('evaluationForms')->flatten()->where('severity', 'Minimal depression')->count(),
        //             'mild' => $group->pluck('evaluationForms')->flatten()->where('severity', 'Mild depression')->count(),
        //             'moderate' => $group->pluck('evaluationForms')->flatten()->where('severity', 'Moderate depression')->count(),
        //             'moderately_severe' => $group->pluck('evaluationForms')->flatten()->where('severity', 'Moderately severe depression')->count(),
        //             'severe' => $group->pluck('evaluationForms')->flatten()->where('severity', 'Severe depression')->count(),
        //         ];
        //     });


        return view('manager.evaluation-report', compact('data'));
    }
}
