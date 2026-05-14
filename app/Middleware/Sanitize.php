<?php

namespace App\Middleware;

class Sanitize
{

    /**
     * Clean input based on content type.
     * Passwords are returned untouched to preserve integrity.
     */
    public static function clean($value)
    {
        $value = trim($value);

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return filter_var($value, FILTER_SANITIZE_EMAIL);
        }

        return preg_replace("/[^a-zA-Z0-9]/", "", $value);
    }

    private function trigger404(): void
    {

        http_response_code(404);

        if (file_exists(ROOT . '/templates/404.php')) {
            require_once ROOT . '/templates/404.php';
        } else {
            echo "404 - Page Not Found";
        }
        exit();
    }
}
