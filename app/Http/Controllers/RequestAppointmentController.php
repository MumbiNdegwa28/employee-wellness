<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\MessageNotification

class RequestAppointmentController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $message = $request->message;

        // Send the message notification
        $user->notify(new MessageNotification($message, $user));

        // Broadcast the event
        broadcast(new MessageSent($message, $user))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}