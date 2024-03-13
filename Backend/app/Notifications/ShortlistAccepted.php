<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShortlistAccepted extends Notification
{
    use Queueable;

    protected $shortlist;
    /**
     * Create a new notification instance.
     */
    public function __construct($shortlist)
    {
        $this->shortlist = $shortlist;
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
                    ->subject($this->shortlist['subject'])
                    ->line($this->shortlist['salutation'])
                    ->line($this->shortlist['body'])
                    ->line($this->shortlist['closing'])
                    ->line($this->shortlist['recruiter'])
                    ->line('Thank you for using our application!');
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
