<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransportRequestDeclinedNotification extends Notification
{
    use Queueable;

    public $transportRequest;
    public $declinedReason;

    /**
     * Create a new notification instance.
     */
    public function __construct($transportRequest, $declinedReason = null)
    {
        $this->transportRequest = $transportRequest;
        $this->declinedReason = $declinedReason;
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
        if ($notifiable->hasRole('admin')) {
            // Get the user that made the request
            $user = $this->transportRequest->user;

            return (new MailMessage)
                ->subject(__('Transport Request Declined'))
                ->greeting(__('Hello, ' . $notifiable->name . '!'))
                ->line(__('Transport request has been declined for ' . $user->name . '.'))
                ->line(__('Title: ' . $this->transportRequest->title))
                ->line(__('Description: ' . $this->transportRequest->description))
                ->line(__('Reason: '. $this->declinedReason))
                ->action(__('View Request'), url('admin/transport_requests/' . $this->transportRequest->id));
        }

        return (new MailMessage)
            ->subject(__('Transport Request Declined'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('Your transport request has been declined.'))
            ->line(__('Title: ' . $this->transportRequest->title))
            ->line(__('Description: ' . $this->transportRequest->description))
            ->line(__('Reason: '. $this->declinedReason))
            ->action(__('View Request'), url('transport_requests/' . $this->transportRequest->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if ($notifiable->hasRole('admin')) {
            return [
                'subject' => 'Transport Request Declined',
                'message' => 'Reason: ' . $this->declinedReason,
                'action' => url('admin/transport_requests/' . $this->transportRequest->id),
            ];
        }
        return [
            'subject' => 'Transport Request Declined',
            'message' => 'Reason: ' . $this->declinedReason,
            'action' => url('transport_requests/' . $this->transportRequest->id),
        ];
    }
}
