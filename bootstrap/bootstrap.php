<?php
use Router\Router;
require ROOT . "/vendor/autoload.php";
require ROOT . "/bootstrap/config.php";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
Router::Router($path);
