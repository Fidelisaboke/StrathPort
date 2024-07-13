<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Spatie\Permission\Models\Role;
use App\Notifications\NewUserRegisteredNotification;

class UserRegisteredNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        $user = $event->user;

        try {
            $adminRole = Role::findByName('admin');
            $admins = $adminRole->users;
            Notification::send($admins, new NewUserRegisteredNotification($user));
        } catch (\Spatie\Permission\Exceptions\RoleDoesNotExist $e) {
            return;
        }
    }
}
