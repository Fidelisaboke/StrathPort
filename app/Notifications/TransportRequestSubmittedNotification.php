<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransportRequestSubmittedNotification extends Notification
{
    use Queueable;

    public $transportRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($transportRequest)
    {
        $this->transportRequest = $transportRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Transport Request Submitted'))
            ->greeting(__('Hello!'))
            ->line(__('Your transport request has been submitted successfully.'))
            ->line(__('Title: ' . $this->transportRequest->title))
            ->line(__('Description: ' . $this->transportRequest->description))
            ->line(__('You will receive an email once your request has been approved.'))
            ->action(__('View Request'), url('transport_requests'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your transport request has been submitted successfully. You will receive an email once your request has been approved.',
            'action' => route('transport_requests.index'),
        ];
    }
}
