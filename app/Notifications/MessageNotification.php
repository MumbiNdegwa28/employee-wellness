<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class MessageNotification extends Notification
{
    use Queueable;

    public $message;
    public $sender;
    //sheila
    public $feedback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $sender, $feedback)
    {
        $this->message = $message;
        $this->sender = $sender;
        //sheila
        $this->feedback = $feedback;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have received a new message.')
                    ->line($this->message)
                    ->action('View Message', url('/'))
                    //sheila
                    ->line('Feedback ID: ' . $this->feedback->id)
                    ->line('Feedback Title: ' . $this->feedback->title)
                    ->line('Feedback Description: ' . $this->feedback->description)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
            ],
            //sheila
            'feedback' => [
                'id' => $this->feedback->id,
                'title' => $this->feedback->title,
                'description' => $this->feedback->description,
            ],
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
            ],
            //sheila
            'feedback' => [
                'id' => $this->feedback->id,
                'title' => $this->feedback->title,
                'description' => $this->feedback->description,
            ],
        ]);
    }
}
