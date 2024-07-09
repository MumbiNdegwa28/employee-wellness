<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\FeedbackMessage;
use App\Events\FeedbackMessageSent;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('employee')->get(); // Assuming you have a relationship set up with Employee
        // Return the view with the feedback data
        return view('manager.feedback.index', compact('feedbacks'));
    }
    // Method to show a specific feedback
    public function show($id)
    {
        // Find feedback by ID
        $feedback = Feedback::findOrFail($id);
        $feedback = Feedback::with('employee')->findOrFail($id);
        // Return the view with the specific feedback
        return view('manager.feedback.show', compact('feedback'));
    }
    public function storeMessage(Request $request, $feedbackId)
    {
        $message = FeedbackMessage::create([
            'user_id' => auth()->id(),
            'feedback_id' => $feedbackId,
            'message' => $request->message,
        ]);

        broadcast(new FeedbackMessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
