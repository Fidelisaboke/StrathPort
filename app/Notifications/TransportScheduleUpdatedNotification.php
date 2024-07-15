<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransportScheduleUpdatedNotification extends Notification
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
                ->subject(__('Transport Schedule Updated'))
                ->greeting(__('Hello, ' . $notifiable->name . '!'))
                ->line(__('A transport schedule has been updated.'))
                ->line(__('Title: ' . $this->transportSchedule->title))
                ->line(__('Description: ' . $this->transportSchedule->description))
                ->line(__('Schedule Date: ' . $this->transportSchedule->schedule_date))
                ->line(__('Schedule Time: ' . $this->transportSchedule->schedule_time))
                ->line(__('Starting Point: ' . $this->transportSchedule->starting_point))
                ->line(__('Destination: ' . $this->transportSchedule->destination))
                ->line(__('Please login to your account to view the schedule.'))
                ->action(__('View Schedule'), url('admin/transport_schedules/' . $this->transportSchedule->id));

        }

        return (new MailMessage)
            ->subject(__('Transport Schedule Updated'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('Your transport schedule has been updated.'))
            ->line(__('Title: ' . $this->transportSchedule->title))
            ->line(__('Description: ' . $this->transportSchedule->description))
            ->line(__('Schedule Date: ' . $this->transportSchedule->schedule_date))
            ->line(__('Schedule Time: ' . $this->transportSchedule->schedule_time))
            ->line(__('Starting Point: ' . $this->transportSchedule->starting_point))
            ->line(__('Destination: ' . $this->transportSchedule->destination))
            ->line(__('Please login to your account to view the schedule.'))
            ->action(__('View Schedule'), url('transport_schedules/' . $this->transportSchedule->id));
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
                'subject' => __('Transport Schedule Updated'),
                'message' => __('A transport schedule has been updated.'),
                'action' => url('admin/transport_schedules/' . $this->transportSchedule->id)
            ];
        }

        return [
            'subject' => __('Transport Schedule Updated'),
            'message' => __('Your transport schedule has been updated.'),
            'action' => url('transport_schedules/' . $this->transportSchedule->id)
        ];
    }
}
