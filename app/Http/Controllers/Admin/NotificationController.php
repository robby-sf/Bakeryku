<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $notifications = $admin->notifications()
            ->latest()
            ->paginate(20);

        $unreadCount = $admin->unreadNotifications()->count();
        $totalCount = $admin->notifications()->count();

        return view('Admin.Notifications.notifications', compact('notifications', 'unreadCount', 'totalCount'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::guard('admin')->id()) {
            if (request()->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            abort(403);
        }

        $notification->markAsRead();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Notification marked as read',
                'unread_count' => Auth::guard('admin')->user()->unreadNotifications()->count(),
            ]);
        }

        return back()->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function markAllAsRead()
    {
        Auth::guard('admin')->user()->notifications()
            ->unread()
            ->update(['is_read' => true, 'read_at' => now()]);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'All notifications marked as read',
                'unread_count' => 0,
            ]);
        }

        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function unreadCount()
    {
        $count = Auth::guard('admin')->user()->unreadNotifications()->count();

        return response()->json(['unread_count' => $count]);
    }

    public function recent()
    {
        $notifications = Auth::guard('admin')->user()->notifications()
            ->latest()
            ->take(5)
            ->get();

        return response()->json($notifications);
    }
}
