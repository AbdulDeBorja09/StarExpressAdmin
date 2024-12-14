<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function getNotifications()
    {

        $user = Auth::user();
        // $notifications = $user->notifications;
        $notifications = Notification::where('notifiable_id', $user->id)->get();

        return response()->json([
            'notifications' => $notifications
        ]);
    }

    public function markAsRead($notificationId)
    {
        // $user = Auth::user();

        // // Find the specific notification by its ID
        // $notification = $user->notifications()->find($notificationId);

        // if ($notification) {
        //     // Mark the notification as read
        //     $notification->markAsRead();

        //     return response()->json(['message' => 'Notification marked as read']);
        // }

        // return response()->json(['message' => 'Notification not found'], 404);
    }
}
