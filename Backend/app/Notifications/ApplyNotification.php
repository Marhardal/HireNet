<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplyNotification extends Notification
{
    use Queueable;

    private $apply;
    private $post;
    // private $apply;
    /**
     * Create a new notification instance.
     */

    public function __construct($apply, $post)
    {
        $this->apply = $apply;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->apply['subject'])
            ->line($this->apply['salutation'])
            ->line($this->apply['body'])
            ->action($this->apply['text'], url('/'))
            ->line('Thank you for using HireNet!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->post->job->name,
            'post_id' => $this->post->id,
            'title' => $this->post,
        ];
    }
}
