<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;


class FeedbackChatsController extends Controller
{
    public function index()
    {
        // Fetch all chats
        $chats = Feedback::all();

       $feedbacks = Feedback::all();
       $manager = User::where('role', 'manager')->first(); // Adjust this query as needed
      // $manager = Auth::user(); 


        return view('employee.chats', [
            'feedbacks' => $feedbacks,
            'manager' => $manager,
            'chats' => $chats
        ]);
    }

    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return view('employee.chats', compact('notifications'));
    }
    //public function fetchMessages()
    //{
      //  $chats = Chat::with('sender', 'receiver')->get();
    //}

    public function sendMessage(Request $request)
    {
        // Validate the message
        $request->validate([
            'message' => 'required|string|max:255',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $manager = Auth::user(); 

        // Create the message
        $feedback = new Feedback();
        $feedback->message = $request->input('message');
        $feedback->sender_id = Auth::id(); // Set the sender_id (employee)
        $feedback->receiver_id = $manager->id; // Set the receiver_id (manager)
        $feedback->save(); // Save the feedback message to the feedback table

        
        // Redirect back with a success message
        return redirect()->back()->with('status', 'Message sent!');
    }

    public function sendReply(Request $request, $feedbackId)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        $feedback = Feedback::findOrFail($feedbackId);
        // Create the reply
        $reply = new Chat();
        $reply->message = $request->input('reply');
        $reply->sender_id = Auth::id(); // Set the sender_id
        $reply->receiver_id =  $this->getReceiverId(); // Set the receiver_id
        $reply->save();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Reply sent!');
    }
     public function getReceiverId()
    {
         return 1; // Replace with the actual logic to get the receiver_id
    }
}