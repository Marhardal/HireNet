<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacancyApproval extends Notification
{
    use Queueable;

    protected $approved;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($approved, $user)
    {
        $this->approved = $approved;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
        // return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->approved['subject'])
                    ->line($this->approved['salutation'])
                    ->line($this->approved['body'])
                    // ->action('Notification Action', url('/'))
                    ->line($this->approved['closing'])
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
            'data' => $this->user,
        ];
    }
}
