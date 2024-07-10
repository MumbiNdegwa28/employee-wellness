<?php

namespace App\Http\Controllers;

use App\Events\FeedbackReplySent;
use App\Models\FeedbackReply;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FeedbackReplyController extends Controller
{
    public function store(Request $request)
    {
       // Validate request data
       $validatedData = $request->validate([
        'feedback_id' => 'required|exists:feedbacks,id',
        'user_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

    // Create FeedbackReply instance
    $reply = FeedbackReply::create($validatedData);

    // Optionally load related user
    $reply->load('user');

    // Broadcast event
    event(new FeedbackReplySent($reply));

        return response()->json(['success' => true, 'reply' => $reply]);
    }

}
