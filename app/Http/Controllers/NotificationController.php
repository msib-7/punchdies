<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function clear()
    {
        // Clear all notifications for the authenticated user
        auth()->user()->notifications()->delete();

        return response()
                ->json([
                    'success' => true,
                    'message' => 'Notification has been cleared.'
                ]);
    }
}
