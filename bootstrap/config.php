<?php

declare(strict_types=1);
session_start();

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("X-Powered-By: clear-pass");

$dotenv = (Dotenv\Dotenv::createImmutable(ROOT))
    ->load();

function e(mixed $string)
{
    if($string == "" || $string == null){
        return "";
    }else{
        return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
    }
}

function csrf()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function loadHeader(string $pageTitle){
    return require_once ROOT . "/require/header.php";
}

function loadFooter(){
    require_once ROOT . "/require/footer.php";
}

function formatPricing($number){
    return number_format((int) $number, 0, ".", ",");
}

