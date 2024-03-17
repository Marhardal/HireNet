<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacancyApplied extends Notification
{
    use Queueable;

    protected $applied;

    protected $post;

    protected $applicant;

    /**
     * Create a new notification instance.
     */
    public function __construct($applied, $applicant, $post)
    {
        $this->applied = $applied;
        $this->applicant = $applicant;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->applied['subject'])
            ->line($this->applied['salutation'])
            ->line($this->applied['body'])
            ->action('Notification Action', url('/'))
            ->line($this->applied['closing'])
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
            'title' => 'New Application Received.',
            'applicant_id' => $this->applicant->id,
            'message' => auth()->user()->first_name. ' '. auth()->user()->surname .' has submitted their application for '. $this->post->name . ' role.',
            // 'data' => auth()->user()
        ];
    }
}
