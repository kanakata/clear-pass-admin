<?php

namespace App\Models\Paywall;

use App\Middleware\Database;
use DateTime;
use PDO;

class Paywall extends Database
{
    public function Paywall(): bool
    {
        //check if the user is subscribed.
        unset($_SESSION['message']);
        $school_name = $_SESSION['school_name'];
        $sql = "SELECT `expiry date`, `plan`  FROM `subscriptions` WHERE `school name`=?";
        $sql = $this->connectionResource()->prepare($sql);
        $sql->execute([$school_name]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        } else {

            $expiry_date = new DateTime($result['expiry date']);

            $current_date = new DateTime(date("Y-m-d"));

            if ($current_date > $expiry_date) {

                return false;
            } else {
                return true;
            }
        }
    }
}
