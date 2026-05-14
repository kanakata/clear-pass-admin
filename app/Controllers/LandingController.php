<?php

namespace App\Controllers;

class LandingController
{
    public function show() {
        return require ROOT . "/resources/views/landing.php";
    }
}
