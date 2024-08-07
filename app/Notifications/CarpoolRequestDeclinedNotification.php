<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CarpoolRequestDeclinedNotification extends Notification
{
    use Queueable;

    public $carpoolRequest;
    public $declinedReason;

    /**
     * Create a new notification instance.
     */
    public function __construct($carpoolRequest, $declinedReason = null)
    {
        $this->carpoolRequest = $carpoolRequest;
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
        if ($notifiable->hasRole('carpool_driver')) {
            // Get the user that made the request
            $user = $this->carpoolRequest->user;

            return (new MailMessage)
                ->subject(__('Carpool Request Declined'))
                ->greeting(__('Hello, ' . $notifiable->name . '!'))
                ->line(__('Carpool request has been declined for ' . $user->name . '.'))
                ->line(__('Title: ' . $this->carpoolRequest->title))
                ->line(__('Description: ' . $this->carpoolRequest->description))
                ->line(__('Reason: '. $this->declinedReason))
                ->line(__('Please login to your account to view the request.'))
                ->action(__('View Request'), url('driver/carpool_requests/' . $this->carpoolRequest->id));
        }

        return (new MailMessage)
            ->subject(__('Carpool Request Declined'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('Your carpool request has been declined.'))
            ->line(__('Title: ' . $this->carpoolRequest->title))
            ->line(__('Description: ' . $this->carpoolRequest->description))
            ->line(__('Reason: '. $this->declinedReason))
            ->line(__('Please login to your account to view the request.'))
            ->action(__('View Request'), url('carpool_requests/' . $this->carpoolRequest->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if ($notifiable->hasRole('carpool_driver')) {
            return [
                'subject' => __('Carpool Request Declined'),
                'message' => 'Reason: ' . $this->declinedReason,
                'action' => url('driver/carpool_requests/' . $this->carpoolRequest->id),
            ];
        }
        return [
            'subject' => __('Carpool Request Declined'),
            'message' => 'Reason: ' . $this->declinedReason,
            'action' => url('carpool_requests/' . $this->carpoolRequest->id),
        ];
    }
}
