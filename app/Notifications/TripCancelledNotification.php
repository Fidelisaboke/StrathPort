<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TripCancelledNotification extends Notification
{
    use Queueable;

    public $transportSchedule;

    /**
     * Create a new notification instance.
     */
    public function __construct($transportSchedule)
    {
        $this->transportSchedule = $transportSchedule;
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
                ->subject(__('Trip Cancelled'))
                ->greeting(__('Hello!'))
                ->line(__('A trip has been cancelled.'))
                ->line(__('Title:' . $this->transportSchedule->title))
                ->line(__('Description:' . $this->transportSchedule->description))
                ->line(__('Schedule Date:' . $this->transportSchedule->schedule_date))
                ->line(__('Schedule Time:' . $this->transportSchedule->schedule_time))
                ->line(__('Starting Point:' . $this->transportSchedule->starting_point))
                ->line(__('Destination:' . $this->transportSchedule->destination))
                ->line(__('Please login to your account to view the trip.'))
                ->action(__('View Trip'), url('admin/transport_schedules'));
        }
        return (new MailMessage)
            ->subject(__('Trip Cancelled'))
            ->greeting(__('Hello!'))
            ->line(__('Your trip has been cancelled.'))
            ->line(__('Title:' . $this->transportSchedule->title))
            ->line(__('Description:' . $this->transportSchedule->description))
            ->line(__('Schedule Date:' . $this->transportSchedule->schedule_date))
            ->line(__('Schedule Time:' . $this->transportSchedule->schedule_time))
            ->line(__('Starting Point:' . $this->transportSchedule->starting_point))
            ->line(__('Destination:' . $this->transportSchedule->destination))
            ->line(__('Please login to your account to view the trip.'))
            ->action(__('View Trip'), url('transport_schedules'));
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
                'message' => 'A trip has been cancelled. Please login to your account to view the trip.',
                'action' => route('admin.transport_schedules.index'),
            ];
        }
        return [
            'message' => 'Your trip has been cancelled. Please login to your account to view the trip.',
            'action' => route('transport_schedules.index'),
        ];
    }
}
