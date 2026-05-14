<?php

namespace App\Middleware;

class Csrf
{
    public function csrfGenerator()
    {
        $timestamp = time();
        $csrfToken = base64_encode(random_int(1000000, 1000000000) . random_int(1000000, 1000000000) . $timestamp);
        return $_SESSION['csrf'] = $csrfToken;
    }
}
