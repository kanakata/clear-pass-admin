<?php

namespace App\Controllers;

use App\Controllers\view_controller;
use App\Models\Payments\Payments;
use App\Models\Query\SharedQueries;

class PayoutController
{
    public function show()
    {



        $payload = new SharedQueries();
        $currentDepartments = $_SESSION['departments'] ?? null;

        if (isset($_GET['continue'])) {
            $currentDepartments = $payload->collectSchoolSubscriptionData()['departments'];
            $currentPlan = $payload->collectSchoolSubscriptionData()['plan'];
            $planDetails = $payload->collectPlansDataPayoutPage($currentPlan);
            $departments = array_values($payload->Display_departments_data());
            $_SESSION['departments'] = $currentDepartments;
        }

        $amount = $_SESSION['value'] ?? $planDetails['value'];
        $plan = $_SESSION['plan'] ?? $currentPlan;

        if (isset($_POST['complete_payment'])) {
            $payment = new Payments();
            $_SESSION['amount'] = $amount;
            $_SESSION['account'] = $_POST['account'];
            $payment->Payment_handler($_POST['method']);
        }

        return require ROOT . "/resources/views/payout.php";
    }
}
