<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationForm;

class EvaluationReportController extends Controller
{
    public function index()
    {
        $evaluationForms = EvaluationForm::all();
        return view('evaluation-report', compact('evaluationForms'));
    }
    public function show($id)
{
    $evaluationForm = EvaluationForm::findOrFail($id);
    return view('evaluation-show', compact('evaluationForm'));
}
}
