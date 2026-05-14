<?php

namespace App\Controllers;

use App\Services\AuthService; // Better to move logic to a Service class
use App\Http\Response;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this0->authService = $authService;
    }

    public function login(): Response
    {
        // 1. Get Request Data
        // 2. Call Service
        $result = $this->authService->attemptLogin($_POST);

        // 3. Return a clean JSON response
        return new Response($result);
    }

    public function register(): Response
    {
        $result = $this->authService->attemptRegistration($_POST);
        return new Response($result);
    }
}