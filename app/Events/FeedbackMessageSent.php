<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
//use App\Models\Feedback;
use App\Models\User;
use App\Models\Chat;

class FeedbackMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $chat;
    //public $feedback;
    public $user;
    public function __construct(Chat $chat, $user, $feedback)
    {
        $this->chat = $chat;
        $this->user = $user;
        //$this->feedback = $feedback;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('feedback.' . $this->chat->receiver_id),
        ];
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->chat->message,
            'sender_id' => $this->chat->sender_id,
            //'user' => $this->user,
            //'feedback' => $this->feedback,
        ];
    }
}
