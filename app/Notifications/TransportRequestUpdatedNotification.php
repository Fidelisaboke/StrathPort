<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransportRequestUpdatedNotification extends Notification
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
        if($notifiable->hasRole('admin')){
            return (new MailMessage)
                ->subject(__('Transport Request Updated'))
                ->greeting(__('Hello, ' . $notifiable->name . '!'))
                ->line(__('A transport request has been updated.'))
                ->line(__('Title: ' . $this->transportRequest->title))
                ->line(__('Description: ' . $this->transportRequest->description))
                ->line(__('Event Date: ' . $this->transportRequest->event_date))
                ->line(__('Event Time: ' . $this->transportRequest->event_time))
                ->line(__('Event Location: ' . $this->transportRequest->event_location))
                ->line(__('Number of People: ' . $this->transportRequest->no_of_people))
                ->line(__('Please login to your account to view the request.'))
                ->action(__('View Request'), url('admin/transport_requests/' . $this->transportRequest->id));
        }

        return (new MailMessage)
            ->subject(__('Transport Request Updated'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('Your transport request has been updated.'))
            ->line(__('Title: ' . $this->transportRequest->title))
            ->line(__('Description: ' . $this->transportRequest->description))
            ->line(__('Event Date: ' . $this->transportRequest->event_date))
            ->line(__('Event Time: ' . $this->transportRequest->event_time))
            ->line(__('Event Location: ' . $this->transportRequest->event_location))
            ->line(__('Number of People: ' . $this->transportRequest->no_of_people))
            ->line(__('Please login to your account to view the request.'))
            ->action(__('View Request'), url('transport_requests/' . $this->transportRequest->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if($notifiable->hasRole('admin')){
            return [
                'subject' => __('Transport Request Updated'),
                'message' => __('A transport request has been updated.'),
                'action' => url('admin/transport_requests/' . $this->transportRequest->id),
            ];
        }

        return [
            'subject' => __('Transport Request Updated'),
            'message' => __('Your transport request has been updated.'),
            'action' => url('transport_requests/' . $this->transportRequest->id),
        ];
    }
}
