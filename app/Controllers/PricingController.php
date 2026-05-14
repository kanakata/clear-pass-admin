<?php

namespace App\Controllers;

use App\Models\Query\ConfigQuery;
use App\Models\Query\PricingQuery;

class PricingController extends PricingQuery
{

    public function show()
    {
        $planData = $this->collectPlansData();
        $presentPlan = null;
        $departments = $this->collectDepartmentsData();

        if (isset($_POST['proceed'])) {

            $_SESSION['limit'] = $_POST['limit'];
            $_SESSION['value'] = $_POST['value'];
            $_SESSION['plan'] = $_POST['plan'];
            $_SESSION['departments'] = $_POST['department'];

            header("location: /payout");
            exit();
        }

        require ROOT . "/resources/views/pricing.php";
    }
}
