<?php
namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Events\NewNotification;

class NotificationService
{
    public static function send($type, $message, $link = null, $permission = null, $data = null)
    {
        $notification = Notification::create([
            'type' => $type,
            'message' => $message,
            'link' => $link,
            'permission' => $permission,
            'data' => $data ? json_encode($data) : null,
        ]);

        // Get users with the specified permission
        $users = User::whereHas('adminTypes.permissions', function($query) use ($permission) {
            $query->where('slug', $permission);
        })->get();

        // Attach notification to eligible users
        $notification->users()->attach($users->pluck('id'));

        // Broadcast event for real-time updates
        broadcast(new NewNotification($notification))->toOthers();

        return $notification;
    }
}
