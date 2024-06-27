<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    // Return the chat view
    public function index()
    {
        return view('chat');
    }

    // Fetch all messages with the user relationship loaded
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    // Handle sending a message
    public function sendMessage(Request $request)
    {
        $user = User::find(auth()->id());
        $message = $request->input('message');

        event(new MessageSent($user, $message));

        return ['status' => 'Message Sent!'];
    }
}
