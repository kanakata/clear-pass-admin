<?php

namespace App\Controllers;

use App\Models\Auth\Login;

class LoginController
{
    public function show()
    {
        $action_status = "";

        if (isset($_POST['login'])) {
            $service = new Login();
            $action_status = $service->loginUser();
        }

        return require ROOT . "/resources/views/login.php";
    }
}
