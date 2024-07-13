<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        auth()->user()->unreadNotifications->find($id)->markAsRead();
        return response()->json(['success' => true]);
    }
}
