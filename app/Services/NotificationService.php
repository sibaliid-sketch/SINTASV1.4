<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a notification for admin users
     */
    public static function notifyAdmins(string $type, string $title, string $message, array $data = [])
    {
        $adminUsers = User::where('role', 'admin')->get();

        foreach ($adminUsers as $admin) {
            Notification::create([
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'data' => $data,
                'user_id' => $admin->id,
            ]);
        }
    }

    /**
     * Create a notification for a specific user
     */
    public static function notifyUser(User $user, string $type, string $title, string $message, array $data = [])
    {
        return Notification::create([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'user_id' => $user->id,
        ]);
    }

    /**
     * Get unread notifications for a user
     */
    public static function getUnreadNotifications(User $user)
    {
        return $user->notifications()->unread()->latest()->get();
    }

    /**
     * Mark notification as read
     */
    public static function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
    }

    /**
     * Mark all notifications as read for a user
     */
    public static function markAllAsRead(User $user)
    {
        $user->notifications()->unread()->update(['read_at' => now()]);
    }
}
