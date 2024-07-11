<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\MessageNotification;
use App\Events\MessageSent;
// use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Message;
use App\Models\Reply;
use App\Events\ReplySent;
use Illuminate\Support\Facades\Auth;

class RequestAppointmentController extends Controller
{
    public function index()
    {
        // Retrieve all messages for the authenticated user
        $user = Auth::user();
        $messages = Message::where('sender_id', $user->id)->orWhere('receiver_id', $user->id)->with('replies')->get();
        return view('employee.requestappointments', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        // Validate the message
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        
        // Create the message
        $message = Message::create([
            'content' => $request->input('message'),
            'sender_id' => Auth::id(),
            'receiver_id' => $this->getTherapistId(),
        ]);

        // Get the validated message content
        $messageContent = $request->input('message');

        // Get the authenticated user
        $user = Auth::user();

        // Find therapists (or a specific therapist)
        $therapists = User::whereHas('role', function($query) {
            $query->where('role_name', 'Therapist');
        })->get();

        foreach ($therapists as $therapist) {
            // Send the notification
            $therapist->notify(new MessageNotification($messageContent, $user));

            // Trigger the event for Pusher
            event(new MessageSent($messageContent, $user, $therapist));
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Message sent!');
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

        // Trigger the reply event
        event(new ReplySent($reply->content, $message->sender));

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Reply sent!');
    }
    private function getTherapistId()
    {
        // Assuming you have a method to get a specific therapist ID
        // You may want to modify this according to your application logic
        $therapist = User::whereHas('role', function ($query) {
            $query->where('role_name', 'Therapist');
        })->first();

        return $therapist ? $therapist->id : null;
    }

}
