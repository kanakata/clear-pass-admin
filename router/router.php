<?php
namespace Router;

class Router
{
    private static array $allowed_pages = [
        "/",
        "/notification",
        "/register",
        "/login",
        "/check",
        "/admin_actions",
        "/dashboard",
        "/landing",
        "/payout",
        "/pricing",
        "/pricing-back",
        "/404"
    ];

    public static function router(string $path)
    {
        // Normalize path
        $path = ($path === "/") ? "/landing" : $path;

        // Special cases (Ideally these should be in a Controller too!)
        if ($path === "/logout") return self::logOut();
        if ($path === "/pricing-back") return self::pricingBack();

        if (in_array($path, self::$allowed_pages)) {
            return self::web($path);
        }

        self::notFound();
    }

    private static function web(string $path)
    {
        $controllerName = self::createControllerName($path);
        $fullClass = "App\Controllers\\" . $controllerName;

        if (class_exists($fullClass)) {
            $controller = new $fullClass();
            return $controller->show();
        }

        self::notFound();
    }

    private static function createControllerName(string $path): string
    {

        $name = ucfirst(ltrim($path, '/'));
        $name = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));

        return $name . "Controller";
    }

    private static function notFound()
    {
        http_response_code(404);
        include ROOT . "/views/404.php"; 
        exit();
    }

    private static function pricingBack()
    {
        unset($_SESSION['value']);
        unset($_SESSION['plan']);
        unset($_SESSION['departments']);
        unset($_SESSION['limit']);
        header("location: /pricing");
        exit();
    }

    // ... logOut and pricingBack remain for now, but move them to a 'SessionController' soon!
}


