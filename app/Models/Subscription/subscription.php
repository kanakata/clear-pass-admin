<?php

namespace App\Models\Subscription;

use App\Middleware\Middleware;

class Subscription extends Middleware
{
    protected function subscription()
    {
        $current_timestamp = time();
        $timestamp = ($current_timestamp + (84000 * 30));

        $expiry_date = date("Y-m-d", $timestamp);
        $departments = $_SESSION['departments'];


        $sql = "INSERT INTO `subscriptions` (`school email`, `school phone`, `school name`, `plan`, `expiry date`, `department1`, `department2`, `department3`, `department4`, `department5`, `department6`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $sql = $this->Connection_resource()->prepare($sql);
        $sql->bindParam(1, $_SESSION['school_email']);
        $sql->bindParam(2, $_SESSION['school_phone']);
        $sql->bindParam(3, $_SESSION['school_name']);
        $sql->bindParam(4, $_SESSION['plan']);
        $sql->bindParam(5, $expiry_date);
        $sql->bindParam(6, $departments[0]);
        $sql->bindParam(7, $departments[1]);
        $sql->bindParam(8, $departments[2]);
        $sql->bindParam(9, $departments[3]);
        $sql->bindParam(10, $departments[4]);
        $sql->bindParam(11, $departments[5]);

        $sql->execute();

        header("location: /dashboard");
        exit();
    }
}
