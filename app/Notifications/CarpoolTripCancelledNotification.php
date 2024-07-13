<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CarpoolTripCancelledNotification extends Notification
{
    use Queueable;

    public $carpoolingDetail;

    /**
     * Create a new notification instance.
     */
    public function __construct($carpoolingDetail)
    {
        $this->carpoolingDetail = $carpoolingDetail;
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
            return (new MailMessage)
                ->subject(__('Carpool Trip Cancelled'))
                ->greeting(__('Hello, ' . $notifiable->name . '!'))
                ->line(__('A carpool trip has been cancelled.'))
                ->line(__('Title: ' . $this->carpoolingDetail->carpoolRequest->title))
                ->line(__('Description: ' . $this->carpoolingDetail->carpoolRequest->description))
                ->line(__('Schedule Date: ' . $this->carpoolingDetail->carpoolRequest->departure_date))
                ->line(__('Schedule Time: ' . $this->carpoolingDetail->carpoolRequest->departure_time))
                ->line(__('Starting Point: ' . $this->carpoolingDetail->carpoolRequest->starting_point))
                ->line(__('Destination: ' . $this->carpoolingDetail->carpoolRequest->destination))
                ->line(__('Please login to your account to view the trip.'))
                ->action(__('View Trip'), url('driver/carpooling_details/' . $this->carpoolingDetail->id));
        }

        return (new MailMessage)
            ->subject(__('Carpool Trip Cancelled'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('Your carpool trip has been cancelled.'))
            ->line(__('Title: ' . $this->carpoolingDetail->carpoolRequest->title))
            ->line(__('Description: ' . $this->carpoolingDetail->carpoolRequest->description))
            ->line(__('Schedule Date: ' . $this->carpoolingDetail->carpoolRequest->deparature_date))
            ->line(__('Schedule Time: ' . $this->carpoolingDetail->carpoolRequest->departure_time))
            ->line(__('Starting Point: ' . $this->carpoolingDetail->carpoolRequest->starting_point))
            ->line(__('Destination: ' . $this->carpoolingDetail->carpoolRequest->destination))
            ->line(__('Please login to your account to view the trip.'))
            ->action(__('View Trip'), url('carpooling_details/' . $this->carpoolingDetail->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        if($notifiable->hasRole('carpool_driver')){
            return [
                'subject' => 'Carpool Trip Cancelled',
                'message' => 'A carpool trip has been cancelled. Click this message to view the trip.',
                'action' => url('driver/carpooling_details/' . $this->carpoolingDetail->id),
            ];
        }
        return [
            'subject' => 'Carpool Trip Cancelled',
            'message' => 'Your carpool trip has been cancelled. Click this message to view the trip.',
            'action' => url('carpooling_details/' . $this->carpoolingDetail->id),
        ];
    }
}
