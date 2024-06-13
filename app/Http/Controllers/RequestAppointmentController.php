<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\MessageNotification;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Bus\Queueable;
// use App\Models\RequestAppointment;


class RequestAppointmentController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate the message
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Get the validated message
        $message = $request->input('message');

        // Get the user (assuming you want to notify the authenticated user)
        $user = auth()->user();

        // Send the notification
        Notification::send($user, new MessageNotification($message));

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Message sent!');
    }
}