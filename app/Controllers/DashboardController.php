<?php

namespace App\Controllers;

use App\Models\Query\DashboardQuery;
use App\Models\Query\SharedQueries;

class DashboardController extends DashboardQuery
{
    public function show()
    {
        $controller = new SharedQueries();

        $siteMetrics = $controller->collectSiteMetrics();
        $adminProfile = $controller->collectAdminProfileData();
        $notificationCount = $controller->collectNotifications()['notificationCount'];
        $departments = $controller->collectSchoolSubscriptionData()['departments'];
        $subscriptionPlan = $controller->collectSchoolSubscriptionData()['plan'];

        return require ROOT . "/resources/views/dashboard.php";
    }
}
