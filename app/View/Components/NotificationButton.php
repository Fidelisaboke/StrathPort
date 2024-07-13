<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationButton extends Component
{
    public $unreadNotifications;
    public $notificationCreatedAt;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }

    /**
     * Mark the notification as read.
     */
    public function markAsRead($id)
    {
        auth()->user()->unreadNotifications->find($id)->markAsRead();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-button');
    }
}
