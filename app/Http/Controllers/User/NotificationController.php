<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $notifications = $user->notifications()->paginate(25);

        $user->unreadNotifications()->update(['read_at' => now()]);

        return view('notifications.index', compact('notifications'));
    }
}
