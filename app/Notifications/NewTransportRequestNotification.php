<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTransportRequestNotification extends Notification
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('New Transport Request'))
            ->greeting(__('Hello!'))
            ->line(__('A new transport request has been created.'))
            ->line(__('Title: ' . $this->transportRequest->title))
            ->line(__('Description: ' . $this->transportRequest->description))
            ->line(__('Event Date: ' . $this->transportRequest->event_date))
            ->line(__('Event Time: ' . $this->transportRequest->event_time))
            ->line(__('Event Location: ' . $this->transportRequest->event_location))
            ->line(__('Number of People: ' . $this->transportRequest->no_of_people))
            ->action(__('View Request'), url('admin/transport_requests/' . $this->transportRequest->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'A new transport request has been created. Please login to your account to view the request.',
            'action' => url('admin/transport_requests/' . $this->transportRequest->id),
        ];
    }
}
