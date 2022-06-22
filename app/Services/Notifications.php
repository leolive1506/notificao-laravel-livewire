<?php

namespace App\Services;

use App\Events\Notify;
use App\Models\Notification;

class Notifications
{
    public function allUsers($notification)
    {
        $notification = Notification::create($notification);
        event(new Notify($notification->message));
    }
}
