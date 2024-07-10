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
        $feedbacks = Feedback::with('employee', 'messages.user', 'messages.replies.user')->get(); // Assuming you have a relationship set up with Employee
        $messages = $this->fetchMessages($feedbacks->first()->id ?? null);

        // Return the view with the feedback data
        return view('manager.feedback.index', compact('feedbacks', 'messages'));
    }
    public function sendMessage(Request $request, $feedbackId)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $message = FeedbackMessage::create([
        'feedback_id' => $feedbackId,
        'user_id' => auth()->id(),
        'message' => $request->message,
    ]);

}
private function fetchMessages($feedbackId)
    {
        if ($feedbackId) {
            return Feedback::find($feedbackId)->messages()->with('user', 'replies.user')->get();
        }
        return collect();
    }
    public function storeMessage(Request $request, $feedbackId)
    {
        $message = FeedbackMessage::create([
            'user_id' => auth()->id(),
            'feedback_id' => $feedbackId,
            'message' => $request->message,
        ]);

        return response()->json(['message' => $message->load('user')]);
    }
}
