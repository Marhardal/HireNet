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
    /**
     * Create a new notification instance.
     */

    public function __construct($apply)
    {
        $this->apply = $apply;
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
                    ->subject('Vacancy Applied')
                    ->line($this->apply['first'])
                    ->line($this->apply['second'])
                    ->line($this->apply['third'])
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
            //
        ];
    }
}
