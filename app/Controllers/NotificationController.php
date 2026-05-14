<?php

namespace App\Controllers;

use App\Models\Query\SharedQueries;

class NotificationController extends SharedQueries
{
    public function show()
    {
        $notificationData = $this->collectNotifications();
        return require ROOT . "/resources/views/notification.php";
    }
}
