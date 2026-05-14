<?php

namespace App\Models\Query;

use App\Middleware\Database;
use PDO;

class SharedQueries extends Database
{

    public function collectAdminProfileData()
    {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $stmt = $this->connectionResource()->prepare("SELECT * FROM `login` WHERE `username`=?");
            $stmt->execute([$username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($stmt);
            return $result;
        }
    }

    public function collectPlansDataPayoutPage($plan): array
    {
        $sql = "SELECT * FROM `plans` WHERE `plan`=?";
        $sql = $this->connectionResource()->prepare($sql);
        $sql->execute([$plan]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function collectSchoolSubscriptionData()
    {
        //collecting data for the dept page.
        if (isset($_SESSION['username'])) {
            $stmt = $this->connectionResource()->prepare("SELECT * FROM `subscriptions` WHERE `school name`=?");

            $stmt->execute([$_SESSION['school_name']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($stmt);
            $result = array_values($result);
            $result = array_filter($result);
            $spliced = array_splice($result, 0, 7);

            if ($result) {
                $info = $result;
                return [
                    "departments" => $info,
                    "plan" => $spliced[5],
                ];
            }
        }
    }

    public function collectAvailableDestinations(): array
    {
        $destination = $_POST['location'];
        $sql = $this->connectionResource()->prepare("SELECT * FROM `shipment cost` WHERE location=? ");
        $sql->execute([$destination]);
        $destinationInfo = $sql->fetch(PDO::FETCH_ASSOC);
        unset($sql);
        return $destinationInfo;
    }

    public function collectNotifications(): array
    {
        $count = $this->connectionResource()->prepare("SELECT COUNT(*) FROM `chebisaas notifications`");
        $count->execute();
        $countInfo = $count->fetchColumn();

        $check = $this->connectionResource()->prepare("SELECT * FROM `chebisaas notifications`");
        $check->execute();
        $result = $check->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_GET['delete_notification']) && $_GET['delete_notification'] == "true" && $_GET['id']) {
            $id = $_GET['id'];
            $sql = $this->connectionResource()->prepare("DELETE FROM `chebisaas notifications` WHERE id=?");
            $sql->bindparam(1, $id);
            $sql->execute();
        }

        return [
            "notifications" => $result,
            "notificationCount" => $countInfo,
        ];
    }

    public function collectSiteMetrics(): array
    {
        //first delete any past login data
        $this->deletePastLogins();

        $user_type = "student";
        $uncleared = "uncleared";
        $cleared = "cleared";

        //count all the students in the database.
        $sql = $this->connectionResource()->prepare("SELECT COUNT(*) FROM `chebisaas student data`");
        $sql->execute();
        $totalStudents = $sql->fetchColumn();
        unset($sql);

        //count total signed up students.
        $sql = $this->connectionResource()->prepare("SELECT COUNT(*) FROM `chebisaas login`");
        $sql->execute();
        $totalSignedUpStudents = $sql->fetchColumn();
        unset($sql);

        //count total uncleared students.
        $sql = $this->connectionResource()->prepare("SELECT COUNT(*) FROM  `chebisaas student data` WHERE `clearance status`=?");
        $sql->execute([$uncleared]);
        $totalUnclearedStudents = $sql->fetchColumn();
        unset($sql);

        //count total uncleared students.
        $sql = $this->connectionResource()->prepare("SELECT COUNT(*) FROM  `chebisaas student data` WHERE `clearance status`=?");
        $sql->execute([$cleared]);
        $totalClearedStudents = $sql->fetchColumn();
        unset($sql);

        //count total login data for the current date.
        $currentDate = date("Y-m-d");
        $sql = $this->connectionResource()->prepare("SELECT COUNT(*) FROM  `chebisaas login register` WHERE `date`=?");
        $sql->execute([$currentDate]);
        $loginCount = $sql->fetchColumn();
        unset($sql);

        return [
            "totalStudents" => $totalStudents,
            "totalSignedUpStudents" => $totalSignedUpStudents,
            "totalUnclearedStudents" => $totalUnclearedStudents,
            "totalClearedStudents" => $totalClearedStudents,
            "loginCount" => $loginCount
        ];
    }

    private function deletePastLogins()
    {
        $currentDate = date("Y-m-d");
        $sql = $this->connectionResource()->prepare("DELETE FROM  `chebisaas login register` WHERE `date`!=?");
        $sql->execute([$currentDate]);
        unset($sql);
    }
}
