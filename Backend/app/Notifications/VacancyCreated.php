<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacancyCreated extends Notification
{
    use Queueable;

    protected $created;

    /**
     * Create a new notification instance.
     */
    public function __construct($created)
    {
        $this->created = $created;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->created['subject'])
            ->line($this->created['salutation'])
            ->line($this->created['body'])
            ->action('Notification Action', url('/'))
            ->line($this->created['closing'])
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
            'data' => auth()->user()
        ];
    }
}
