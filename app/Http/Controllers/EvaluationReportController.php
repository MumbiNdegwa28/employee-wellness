<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationReportController extends Controller
{
    public function index()
    {
        return view('evaluation-report');
    }
}
