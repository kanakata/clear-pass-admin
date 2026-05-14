<?php

namespace App\Models\Database;

use PDO;
use Exception;

class DatabaseObject
{
    private string $dsn;
    private string $password;
    private string $username;
    private ?PDO $connection = null;
    public function __construct()
    {
        $this->dsn = $_ENV['DATABASE_DSN'];
        $this->username = $_ENV['DATABASE_USERNAME'];
        $this->password = $_ENV['DATABASE_PASSWORD'];
    }
    public function connect()
    {
        try {
            if ($this->connection == null) {
                $this->connection = new PDO($this->dsn, $this->username, $this->password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
            }
            return $this->connection;
        } catch (Exception $e) {

            $this->logError($e);
        }
    }

    private function logError(Exception $e)
    {
        $timestamp = time();
        $error_time = date("y/m/d h:i:s A", $timestamp);
        $error = "Error (database connection): " .  $e->getMessage() . ", on file: " . $e->getFile() . ", on line: " . $e->getLine() . " on : " .  $error_time . "." . PHP_EOL;
        $error_file_path = ROOT .  "/storage/logs/database_errors.log";
        if (file_exists($error_file_path)) {
            file_put_contents($error_file_path, $error, FILE_APPEND | LOCK_EX);
        }
    }
}