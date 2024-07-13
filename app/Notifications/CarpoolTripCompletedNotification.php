<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CarpoolTripCompletedNotification extends Notification
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
        if($notifiable->hasRole('carpool_driver'))
        {
            return (new MailMessage)
                ->subject(__('Carpool Trip Completed'))
                ->greeting(__('Hello, ' . $notifiable->name . '!'))
                ->line(__('Your carpool trip has been completed.'))
                ->line(__('Title: ' . $this->carpoolingDetail->title))
                ->line(__('Description: ' . $this->carpoolingDetail->description))
                ->line(__('Schedule Date: ' . $this->carpoolingDetail->schedule_date))
                ->line(__('Schedule Time: ' . $this->carpoolingDetail->schedule_time))
                ->line(__('Starting Point: ' . $this->carpoolingDetail->starting_point))
                ->line(__('Destination: ' . $this->carpoolingDetail->destination))
                ->line(__('Please login to your account to view the trip.'))
                ->action(__('View Trip'), url('driver/carpooling_details/' . $this->carpoolingDetail->id));
        }

        return (new MailMessage)
            ->subject(__('Carpool Trip Completed'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('Your carpool trip has been completed.'))
            ->line(__('Title: ' . $this->carpoolingDetail->title))
            ->line(__('Description: ' . $this->carpoolingDetail->description))
            ->line(__('Schedule Date: ' . $this->carpoolingDetail->schedule_date))
            ->line(__('Schedule Time: ' . $this->carpoolingDetail->schedule_time))
            ->line(__('Starting Point: ' . $this->carpoolingDetail->starting_point))
            ->line(__('Destination: ' . $this->carpoolingDetail->destination))
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
        return [
            'subject' => 'Carpool Trip Completed',
            'message' => 'Your carpool trip has been completed.',
            'action' => url('carpooling_details/' . $this->carpoolingDetail->id)
        ];
    }
}
