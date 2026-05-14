<?php

namespace App\Models\Query;

use App\Middleware\Database;
use PDO;
class PricingQuery extends Database
{
    //private $dbConnection;
    protected function collectPlansData(): array
    {
        $sql = "SELECT * FROM `plans`";
        $sql = $this->connectionResource()->prepare($sql);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    protected function collectDepartmentsData(): array
    {
        $sql = "SELECT * FROM `departments`";
        $sql = $this->connectionResource()->prepare($sql);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    
}
