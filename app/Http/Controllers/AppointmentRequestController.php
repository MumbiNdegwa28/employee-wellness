<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;


class AppointmentRequestController extends Controller
{
    public function index()
    {
        return view('therapist.appointmentrequests');
    }
    public function sendMessage(Request $request)
    {
        // Validate the message
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Get the validated message
        $message = $request->input('message');

        // Get all therapists
        $therapists = User::whereHas('role', function($query) {
            $query->where('role_name', 'Therapist'); // Use 'role_name' instead of 'name'
        })->get();

        // Send the notification to all therapists
        foreach ($therapists as $therapist) {
            $therapist->notify(new MessageNotification($message));
        }

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Message sent to all therapists!');
    }
}

