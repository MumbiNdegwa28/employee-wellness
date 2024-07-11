<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\MessageNotification;
// use App\Events\MessageSent;
// use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Message;
use App\Models\Reply;
use App\Events\ReplySent;
use Illuminate\Support\Facades\Auth;

class AppointmentRequestController extends Controller
{
    public function index()
    {
        // Retrieve all messages for the authenticated user (therapist)
        $user = Auth::user();
        $messages = Message::where('receiver_id', $user->id)->with('replies')->get();
        
        return view('therapist.appointmentrequests', compact('messages'));
    }

    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return view('therapist.appointmentrequests', compact('notifications'));
    }

    
    public function sendReply(Request $request, $messageId)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        // Create the reply
        $reply = Reply::create([
            'content' => $request->input('reply'),
            'message_id' => $messageId,
            'user_id' => Auth::id(),
        ]);

        // Find the original message
        $message = Message::find($messageId);

        // Get the authenticated user
        $user = User::FindOrFail($reply->user_id);
        $auth_user = Auth::user();
        $user->notify(new MessageNotification($reply->content, $auth_user));

        // Trigger the reply event
        event(new ReplySent($reply->content, $message->sender));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Reply sent!');
    }
}