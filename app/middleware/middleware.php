<?php

namespace App\Middleware;

use App\Models\Database\Database;

abstract class Middleware extends Database
{
    private static $db_connect = null;
    private static $connection = null;
    //handles brute force attacks.
    protected static function General_connection_resource()
    {
        return self::$connection = parent::Database_connect("schoolclearancesite", "mysql");
    }

    protected static function Brute_force_connection_resource()
    {
        return self::$connection = parent::Database_connect("naughty-list", "sqlite");
    }
    protected static function Brute_force_mitigator($id, $ip): void {
        self::$db_connect = self::General_connection_resource();
        //check if the user is in the naughty list.
    }

    //handle error logging for auditing.
    protected static function Error_logger() {}
}
