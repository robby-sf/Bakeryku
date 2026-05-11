<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user
     */
    public function index()
    {
        $notifications = Auth::guard('user')->user()->notifications()
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::guard('user')->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->markAsRead();

        return response()->json(['message' => 'Notification marked as read']);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        Auth::guard('user')->user()->notifications()
            ->unread()
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json(['message' => 'All notifications marked as read']);
    }

    /**
     * Delete a notification
     */
    public function destroy(Notification $notification)
    {
        if ($notification->user_id !== Auth::guard('user')->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }

    /**
     * Get unread count
     */
    public function unreadCount()
    {
        $count = Auth::guard('user')->user()->unreadNotifications()->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Get recent notifications (for navbar)
     */
    public function recent()
    {
        $notifications = Auth::guard('user')->user()->notifications()
            ->latest()
            ->take(5)
            ->get();

        return response()->json($notifications);
    }
}
