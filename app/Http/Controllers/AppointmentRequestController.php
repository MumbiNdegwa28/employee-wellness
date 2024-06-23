<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\MessageNotification;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Notification;
use App\Models\User;


class AppointmentRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user) {
            $notifications = $user->notifications;
            return view('therapist.appointmentrequests', compact('notifications'));
        } else {
            return redirect()->route('login');
        }
    }
    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return view('appointmentrequests', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('status', 'Notification marked as read!');
    }

    public function sendReply(Request $request)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        // Get the validated reply
        $reply = $request->input('reply');

        // Get all therapists
        $therapists = User::whereHas('role', function($query) {
            $query->where('role_name', 'Therapist');
        })->get();

        // Send the notification to all therapists
        foreach ($therapists as $therapist) {
            $therapist->notify(new MessageNotification($reply));
            event(new MessageSent($reply, $therapist));
        }

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Reply sent to all therapists!');
    }
}
