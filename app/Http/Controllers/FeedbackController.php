<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Chat; // Use Chat model
use App\Models\User; // Assuming Employee is a User
use App\Events\FeedbackMessageSent;
use App\Events\FeedbackReplySent;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        // Fetch all feedbacks
        $feedbacks = Feedback::all();

        // Fetch the employee data (replace with your actual logic)
        $employee = Auth::user(); // Assuming the employee is the authenticated user

        return view('manager.feedback.index', compact('feedbacks', 'employee'));
    }

    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return view('manager.feedback.index', compact('notifications'));
    }

    public function sendMessage(Request $request)
    {
        // Validate the message
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Create a new chat message
        $chat = new Chat();
        $chat->message = $request->input('message');
        $chat->sender_id = Auth::id(); // Set the sender_id (manager)
        $chat->receiver_id = $request->input('receiver_id'); // Set the receiver_id (employee)
        $chat->save(); // Save the chat message to the chats table

       // Redirect back with a success message
    return redirect()->back()->with('status', 'Message sent!');
    }

    public function sendReply(Request $request)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        //$feedback = Feedback::find($feedbackId);

        // Create the reply in the chats table
        $chat = new Chat();
        $chat->message = $request->input('reply');
        $chat->sender_id = Auth::id(); // Set the sender_id (employee)
        $chat->receiver_id = $this->getReceiverId(); // Set the receiver_id (manager)
        $chat->save();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Reply sent!');
    }

    public function getReceiverId()
    {
        return 2; // Replace with the actual logic to get the receiver_id
    }
}