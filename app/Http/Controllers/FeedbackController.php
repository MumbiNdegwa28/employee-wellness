<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\FeedbackMessageSent;
use App\Events\FeedbackReplySent;
use App\Models\FeedbackReply;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        // Example: Fetch feedbacks with their messages and sender details
    $feedbacks = Feedback::with('messages', 'sender')->get();
        return view('manager.feedback.index', compact('feedbacks'));
    }
    public function show($id)
    {
        $feedback = Feedback::with('replies.sender')->findOrFail($id);
        return view('manager.feedback.show', compact('feedback'));
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $message = new Feedback();
        $message->message = $request->message;
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->save();

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'feedback_id' => 'required|exists:feedbacks,id',
            'message' => 'required|string',
            // Add any additional validation rules specific to message creation
        ]);

        // Create Feedback instance
        $feedback = Feedback::create($validatedData);

        // Optionally load related user
        $feedback->load('user');

        // Broadcast event
        event(new FeedbackMessageSent($feedback, $feedback->user));

        return response()->json(['success' => true, 'feedback' => $feedback]);
    }

    public function storeReply(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'feedback_id' => 'required|exists:feedbacks,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        // Create FeedbackReply instance
        $reply = FeedbackReply::create([
            'feedback_id' => $validatedData['feedback_id'],
            'user_id' => $validatedData['user_id'],
            'message' => $validatedData['message'],
        ]);
///heyy
        // Optionally load related user
        $reply->load('user');

        // Get the original feedback instance
        $feedback = $reply->feedback;

        // Broadcast event
        event(new FeedbackReplySent($reply, $reply->user));

        return response()->json(['success' => true, 'reply' => $reply, 'feedback' => $feedback]);
    }

}
