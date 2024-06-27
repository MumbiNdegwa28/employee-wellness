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
        // Retrieve all messages for the authenticated user (therapist)
        $user = auth()->user();
        $notifications = $user->notifications;

        return view('therapist.appointmentrequests', compact('notifications'));
    }

    public function showNotifications(Request $request)
    {
        $notifications = $request->user()->unreadNotifications;

        return view('therapist.appointmentrequests', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back()->with('status', 'Notification marked as read!');
    }

    public function sendReply(Request $request, $notificationId)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:255',
        ]);

        // Get the validated reply
        $reply = $request->input('reply');

        // Find the notification
        $notification = auth()->user()->notifications()->findOrFail($notificationId);

        // Find the employee who sent the message
        $employee = User::findOrFail($notification->data['user']['id']);

        // Send the reply notification to the employee
        $employee->notify(new MessageNotification($reply));
        event(new MessageSent($reply, $employee));

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Reply sent to the employee!');
    }
}
