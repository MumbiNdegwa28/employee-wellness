<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Feedback;
use App\Models\User;
//use App\Models\Chat;

class FeedbackReplySent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    //public $chat;
    public $user;
    public $feedback;
    /**
     * Create a new event instance.
     */
    public function __construct(Feedback $feedback)
    {
        //$this->chat = $chat;
        //$this->user = $user;
        $this->feedback = $feedback;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('feedback.' .$this->feedback->receiver_id),
        ];
    }
    public function broadcastWith(): array
    {
        return [
            'reply' => [
                'message' => $this->feedback->message,
                'sender_id' => $this->feedback->sender_id,
                //'user' => $this->user,
                //'feedback' => $this->feedback,
            ],
        ];
    }
}
