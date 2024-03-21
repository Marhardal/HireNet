<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacancyNotification extends Notification
{
    use Queueable;

    private $vacancy;
    private $user;
    private $post;
    /**
     * Create a new notification instance.
     */
    public function __construct($vacancy, $user, $post)
    {
        $this->vacancy = $vacancy;
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->vacancy['body'])
            ->action($this->vacancy['text'], $this->vacancy['url'])
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'title' => 'New Job Post',
            'message' => $this->post->organisation->name . 'is hiring for a ' . $this->post->job->name . '. Click for more info.',
        ];
    }
}
