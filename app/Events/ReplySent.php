<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Models\User;

class ReplySent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;
    public $user;

    public function __construct($reply, User $user)
    {
        $this->reply = $reply;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('messages.' . $this->user->id);
    }

    public function broadcastWith()
    {
        return [
            'reply' => $this->reply,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
        ];
    }
}
