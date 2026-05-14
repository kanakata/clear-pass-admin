<?php

namespace App\Middleware;

use App\Models\Database\DatabaseObject;

class Database
{
    private $dbFactory;
    private $conn = null;
    private $dbConnection;
    private $site;
    private $schoolName;
    private $schoolStudentData;
    private $schoolLogin;
    private $schoolLoginRegister;
    private $schoolNotifications;
    private $schoolShipmentCost;
    private $schoolShipmentDetails;
    public function __construct()
    {

        $this->schoolName = $_SESSION['school_name'] ?? null;

        //tables
        $this->site = $_ENV['SITE_NAME'];
        if ($this->schoolName !== null) {
            $this->schoolStudentData = $this->schoolName . " student data";
            $this->schoolLogin = $this->schoolName . " login";
            $this->schoolLoginRegister = $this->schoolName . " login register";
            $this->schoolNotifications = $this->schoolName . " notifications";
            $this->schoolShipmentCost = $this->schoolName . " shipment cost";
            $this->schoolShipmentDetails = $this->schoolName . " shipment details";
        }
    }

    public function connectionResource()
    {
        if ($this->conn == null) {
            $this->dbFactory = new DatabaseObject();
            $this->conn = $this->dbFactory->connect();
        }
        return $this->conn;
    }
}
