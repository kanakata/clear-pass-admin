<?php

namespace App\Models\Database;

require_once ROOT . '/vendor/autoload.php';

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->load();

abstract class Database
{
    // Changed to protected so child classes can access them if needed
    protected static $host;
    protected static $password;
    protected static $username;
    protected static $conn = null;

    //configuring credentials.
    private static  function credentials(): array
    {
        // Prevent instantiation of the Database class
        self::$host = $_ENV['DATABASE_HOST'];
        self::$username = $_ENV['DATABASE_USERNAME'];
        self::$password = $_ENV['DATABASE_PASSWORD'];
        return [
            'host' => self::$host,
            'username' => self::$username,
            'password' => self::$password
        ];
    }

    //creating a connection. mysql:host=localhost
    protected static function Database_connect($database, $driver)
    {
        try {
            self::$conn = new PDO($driver . ":" . self::credentials()['host'] .";dbname=" . $database, self::credentials()['username'], self::credentials()['password']);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection errors
            echo ("Database connection error: " . $e->getMessage());
            die("Database connection error");
        }
        return self::$conn;
    }
}
