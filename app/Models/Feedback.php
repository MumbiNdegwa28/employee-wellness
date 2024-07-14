<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedback";

    use HasFactory;
    protected $fillable = [
      'message',
    'sender_id',
    'receiver_id',
  ];

    //public function user()
    //  {
    //    return $this->belongsTo(User::class);
    //}
  // Define the sender relationship
  public function sender()
  {
      return $this->belongsTo(User::class, 'sender_id');
  }

  public function receiver()
  {
      return $this->belongsTo(User::class, 'receiver_id');
  }
   
    //  public function messages()
    //{
    //    return $this->hasMany(Message::class, 'feedback_id','feedback_id');
    //}
   // public function show($id)
//{
   // $feedback = Feedback::with('messages.replies.user', 'messages.user')->findOrFail($id);
     // Debugging
     //dd($feedback);
      //return view('manager.feedback.show', compact('feedback'));
//}

//public function replies()
//    {
   // return $this->hasMany(Reply::class, 'feedback_id');
//}

   // public function scopeBetween($query, $userId1, $userId2)
    //{    
        //return $query->where(function ($query) use ($userId1, $userId2) {
          //  $query->where('sender_id', $userId1)
            //      ->where('receiver_id', $userId2);
        //  })->orWhere(function ($query) use ($userId1, $userId2) {
          //  $query->where('sender_id', $userId2)
            //      ->where('receiver_id', $userId1);
        //  });
    //}
}
