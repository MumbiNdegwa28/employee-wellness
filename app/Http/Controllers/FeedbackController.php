<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('employee')->get();

        return view('manager.feedback', compact('feedbacks'));
    }
    public function show($id)
    {
        $feedback = Feedback::with('employee')->findOrFail($id);
        return view('manager.feedback_show', compact('feedback'));
    }
}
