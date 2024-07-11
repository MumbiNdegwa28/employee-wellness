//<?php

//namespace App\Http\Controllers;

//use App\Models\FeedbackMessage;
//use App\Models\Feedback;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

//class MessageController extends Controller
//{
    //public function index($feedbackId)
    //{
       // $messages = FeedbackMessage::where('feedback_id', $feedbackId)
       //     ->with('user') // Include user details
        //    ->get();

      //  return response()->json($messages);
   // }

    // Store a new message
   // public function store(Request $request, $feedbackId)
   // {
       // $request->validate([
       //     'message' => 'required|string',
      //  ]);

        //$message = new FeedbackMessage();
       // $message->user_id = Auth::id();
       // $message->feedback_id = $feedbackId;
       // $message->message = $request->message;
       // $message->save();

        // Broadcast the new message event (optional)
      //  broadcast(new \App\Events\FeedbackMessageSent($message))->toOthers();

       // return response()->json(['message' => $message]);
  //  }
//}
