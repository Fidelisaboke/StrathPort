<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class NewUserRegisteredNotification extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        // Get the newly registerd user
        $this->user = $user;
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
            ->subject(__('New User Registered'))
            ->greeting(__('Hello, ' . $notifiable->name . '!'))
            ->line(__('A new user has registered.'))
            ->line('User Email: ' . $this->user->email)
            ->line(__('Please login to your account to view the user.'))
            ->action('Login', route('login'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subject' => 'New User Registered',
            'message' => 'A new user has registered. Click this message to view the user.',
            'action' => url('admin/users/'. $this->user->id),
            'user' => $this->user,
        ];
    }
}
