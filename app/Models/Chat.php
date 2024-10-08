<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //protected $table = 'chats';

    use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'created_at', 'updated_at'];

    // Define relationships
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
