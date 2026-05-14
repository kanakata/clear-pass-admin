<?php

namespace App\Controllers;

use App\Controllers\Api_controller;
use App\Models\Query\SharedQueries;

class AdminController
{
    public function show()
    {

        $adminController = new SharedQueries();
        $adminProfile = $adminController->collectAdminProfileData();
        $departments = $adminController->collectSchoolSubscriptionData()['departments'];

        if (isset($_POST['upload'])) {

        }

        $action = $_GET['action'] ?? "";

        /*$request = $_GET['action'];
        $admin_actions_page_requests = [
            'manually_sign_in' => fn() => $this->Manually_sign_in_user(),
            'add_student_data' => fn() => $this->Add_user_data(),
            'update_user' => fn() => $this->Update_user(),
        ];*/

        //$this->result  = $admin_actions_page_requests[$request]();


        require_once ROOT . "/resources/views/components/vendor.php";
        return require ROOT . "/resources/views/adminActions.php";
    }
}
