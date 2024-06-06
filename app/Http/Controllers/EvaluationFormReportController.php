<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationFormReportController extends Controller
{
    public function index()
    {
        return view('evaluation-form-report');
    }
}
