<?php

namespace App\Controllers;

class RegisterController
{
    public function show()
    {

        /*if (isset($_POST['register'])) {
            $controller = new Api_controller();
            $action_status = $controller->registerUser()['message'] ?? null;
        }*/

        return require ROOT . "/resources/views/register.php";
    }
}
