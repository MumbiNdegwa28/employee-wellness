<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Feedback;

class FeedbackChatsController extends Controller
{
    public function index()
    {
        $managerRoleId = 2;
        // Fetch authenticated user's ID
        //$authUserId = Auth::id();
        
        // Get chats where the receiver is a manager (role_id = 2)
        $chats = Chat::whereHas('receiver', function ($query) use ($managerRoleId) {
            $query->where('role_id', $managerRoleId);
        })->with('sender')->get();
    
        // Retrieve the current authenticated user (manager)
        //$manager = User::find($managerRoleId);
    
        // Ensure chats and manager are being passed correctly
        return view('employee.chats', ['chats' => $chats]);
    }

    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return view('employee.chats', compact('notifications'));
    }

    public function sendReply(Request $request, $chatId)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        // Check if chatId is provided
        if ($chatId != 0) {
            // Fetch the chat
            $chat = Chat::findOrFail($chatId);

            // Create the reply in the feedback table
            $feedback = new Feedback();
            $feedback->message = $request->input('reply');
            $feedback->sender_id = Auth::id(); // Set the sender_id (employee)
            $feedback->receiver_id = $chat->sender_id; // Set the receiver_id (manager)
            $feedback->save();
        } else {
            // Handle the case where no chat ID is provided
            // You can set default values or handle it as needed
            $feedback = new Feedback();
            $feedback->message = $request->input('reply');
            $feedback->sender_id = Auth::id(); // Set the sender_id (employee)
            $feedback->receiver_id = 1; // Set a default receiver_id (e.g., admin or manager)
            $feedback->save();
        }

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Reply sent!');
    }
}