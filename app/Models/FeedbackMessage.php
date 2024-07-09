<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'feedback_id', 
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
