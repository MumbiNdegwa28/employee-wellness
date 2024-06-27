<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
<<<<<<< HEAD
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Message;
class MessageSent implements ShouldBroadcast
=======
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast as ShouldBroadcastContract;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow as BroadcastingShouldBroadcastNow;

class MessageSent implements BroadcastingShouldBroadcastNow
>>>>>>> c85e4805930ed1d68de5de041ccc83a6e11cff89
{
    use  InteractsWithSockets, SerializesModels;

    public $message;
    public $user;

    

    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('private-messages.' . $this->user->id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
        ];
    }
}
