<?php

namespace App\Models\Query;

use App\Middleware\Database;
use PDO;
class CheckQuery extends Database
{

    private function initCheckPageVariables()
    {
        $rows = $this->setRowsCookie();
        $page = $_GET['page'] ?? 1;
        $inquiry = $_GET['inquiry'];
        $department = $_GET['department'] ?? '';
        $column = $department . " status";

        return [
            "rows" => $rows,
            "page" => $page,
            "inquiry" => $inquiry,
            "department" => $department,
            "column" => $column,
        ];
    }

    private function setRowsCookie(): string
    {
        // 1. Determine the source (Priority: POST, then COOKIE, then Default)
        $post_rows = $_POST['rows'] ?? null;
        $cookie_rows = $_COOKIE['rows'] ?? null;
        $default = 10;

        // 2. Decide what the current row count should be
        if (!empty($post_rows)) {
            $rows = (int)$post_rows;
        } elseif (!empty($cookie_rows)) {
            $rows = (int)$cookie_rows;
        } else {
            $rows = $default;
        }

        if ($post_rows && $post_rows != $cookie_rows) {
            // Set for 30 days: time() + (86400 * 30)
            setcookie("rows", $rows, time() + 2592000, "/");
        } elseif (!$cookie_rows) {
            setcookie("rows", $default, time() + 2592000, "/");
        }

        return $rows;

    }
    private function collectCheckPageViewStudents(): array
    {
        $initData = $this->initCheckPageVariables();
        //count all the columns of data on the database
        $query = "SELECT COUNT(*) FROM `chebisaas student data`";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute();
        $total = (int)$sql->fetchColumn();
        unset($sql);

        // collect the current page
        $page = $_GET['page'] ?? 1;

        // result per page
        $resultPerPage = $initData['rows'] <= 0 ? 1 : $initData['rows'] ?? 1;

        //pages
        $pages = ceil($total / $initData['rows']);

        //offset
        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` ORDER BY `admission number` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPageViewStudentsUncleared(): array
    {

        $initData = $this->initCheckPageVariables();
        //count all the columns of data on the database
        $query = "SELECT COUNT(*) FROM `chebisaas student data` WHERE `clearance status`=?";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute(['uncleared']);
        $total = (int)$sql->fetchColumn();
        unset($sql);

        // collect the current page
        $page = $_GET['page'] ?? 1;

        // result per page
        $resultPerPage = $initData['rows'] <= 0 ? 1 : $initData['rows'] ?? 1;

        //pages
        $pages = ceil($total / $initData['rows']);

        //offset
        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` WHERE `clearance status`=? ORDER BY `admission number` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute(['uncleared']);

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPageViewStudentsCleared(): array
    {

        $initData = $this->initCheckPageVariables();
        //count all the columns of data on the database
        $query = "SELECT COUNT(*) FROM `chebisaas student data` WHERE `clearance status`=?";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute(['cleared']);
        $total = (int)$sql->fetchColumn();
        unset($sql);

        // collect the current page
        $page = $_GET['page'] ?? 1;

        // result per page
        $resultPerPage = $initData['rows'] <= 0 ? 1 : $initData['rows'] ?? 1;

        //pages
        $pages = ceil($total / $initData['rows']);

        //offset
        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` WHERE `clearance status`=? ORDER BY `admission number` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute(['cleared']);

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPageCleared(): array
    {
        $initData = $this->initCheckPageVariables();
        $column = $initData['department'] . " status";
        $query = "SELECT COUNT(`$column`) FROM `chebisaas student data` WHERE `$column` IN ('cleared', 'online', 'pending_physical_payment')";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute();
        $total = $sql->fetchColumn();
        unset($sql);


        //current page
        $page = $_GET['page'] ?? 1;

        $resultPerPage = $initData['rows'] <= 0 ? 1 :  $initData['rows'] ?? 1;
        //total number of pages

        $pages = ceil($total / $initData['rows']);

        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` WHERE `$column` IN ('cleared', 'online', 'pending_physical_payment') LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPageUncleared(): array
    {
        $initData = $this->initCheckPageVariables();
        $query = "SELECT COUNT(*) FROM `chebisaas student data` WHERE `clearance status`=?";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute([$initData['inquiry']]);
        $total = (int)$sql->fetchColumn();
        unset($sql);

        // collect the current page
        $page = $_GET['page'] ?? 1;

        // result per page
        $resultPerPage = $initData['rows'] <= 0 ? 1 : $initData['rows'] ?? 1;

        //pages
        $pages = ceil($total / $initData['rows']);

        //offset
        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` WHERE `clearance status`=? ORDER BY `admission number` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute([$initData['inquiry']]);
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPageOnline(): array
    {
        $initData = $this->initCheckPageVariables();
        $departmentStatus = $initData['department'] . ' status';
        $query = "SELECT COUNT(*) FROM `chebisaas student data` WHERE `$departmentStatus`=?";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute([$initData['inquiry']]);
        $total = (int)$sql->fetchColumn();
        unset($sql);

        // collect the current page
        $page = $_GET['page'] ?? 1;

        // result per page
        $resultPerPage = $initData['rows'] <= 0 ? 1 : $initData['rows'] ?? 1;

        //pages
        $pages = ceil($total / $initData['rows']);

        //offset
        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` WHERE `$departmentStatus`=? ORDER BY `admission number` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute([$initData['inquiry']]);

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPagePendingPhysicalPayment(): array
    {
        $initData = $this->initCheckPageVariables();
        $departmentStatus = $initData['department'] . " status";
        $query = "SELECT COUNT(*) FROM `chebisaas student data` WHERE `$departmentStatus`=?";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute([$initData['inquiry']]);
        $total = (int)$sql->fetchColumn();
        unset($sql);

        // collect the current page
        $page = $_GET['page'] ?? 1;

        // result per page
        $resultPerPage = $initData['rows'] <= 0 ? 1 : $initData['rows'] ?? 1;

        //pages
        $pages = ceil($total / $initData['rows']);

        //offset
        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas student data` WHERE `$departmentStatus`=? ORDER BY `admission number` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute([$initData['inquiry']]);

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    private function collectCheckPageShipmentDetails(): array
    {
        $initData = $this->initCheckPageVariables();
        $query = "SELECT COUNT(*) FROM `chebisaas shipment details`";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute();
        $total = $sql->fetchColumn();

        //current page
        $page = $_GET['page'] ?? 1;

        $resultPerPage = $initData['rows'] <= 0 ? 1 :  $initData['rows'] ?? 1;
        //total number of pages

        $pages = ceil($total / $initData['rows']);

        $offset = max(0, ($page - 1) * $resultPerPage);

        $query = "SELECT * FROM `chebisaas shipment details` ORDER BY `shipment date` ASC LIMIT $offset, $resultPerPage";
        $sql = $this->connectionResource()->prepare($query);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        return [
            "result" => $result,
            "pages" => $pages,
            "total" => $total,
        ];
    }

    public function collectCheckData(): array
    {
        $checkPageRequests = [
            //departments.
            "cleared" => fn() => $this->collectCheckPageCleared(),
            "uncleared" => fn() => $this->collectCheckPageUncleared(),
            "online" => fn() => $this->collectCheckPageOnline(),
            "pending_physical_payment" => fn() => $this->collectCheckPagePendingPhysicalPayment(),
            "view_students" => fn() => $this->collectCheckPageViewStudents(),
            "view_shipment_details" => fn() => $this->collectCheckPageShipmentDetails(),
            "uncleared_general" => fn() => $this->collectCheckPageViewStudentsUncleared(),
            "cleared_general" => fn() => $this->collectCheckPageViewStudentsCleared(),
        ];

        $data = $checkPageRequests[$_GET['inquiry']]();

        return [
            "checkPageData" => $data['result'],
            "page" => $this->initCheckPageVariables()['page'],
            "pages" => $data['pages'],
            "totalRequests" => $data['total'],
            "totalStudents" => (new SharedQueries())
            ->collectSiteMetrics()['totalStudents'],
        ];
    }

    private function collectSearchDataClearedDepartment()
    {
        $initData = $this->initCheckPageVariables();
        $search = $_POST['search_student'];
        $column = $initData['department'] . " status";
        $query = "SELECT * FROM `chebisaas student data` WHERE `$column`=? AND `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$initData['inquiry'], $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }

    private function collectSearchDataClearedGeneral()
    {
        $search = (int)$_POST['search_student'];
        $column = "clearance status";
        $query = "SELECT * FROM `chebisaas student data` WHERE `$column` IN ('cleared', 'pending_physical_payment') AND `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }

    private function collectSearchDataUnclearedDepartment()
    {
        $initData = $this->initCheckPageVariables();
        $column = $initData['department'] . ' status';
        $search = (int)$_POST['search_student'];
        $query = "SELECT * FROM `chebisaas student data` WHERE `$column`=? AND `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$initData['inquiry'], $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }

    private function collectSearchDataUnclearedGeneral()
    {
        $initData = $this->initCheckPageVariables();
        $column = 'clearance status';
        $search = (int)$_POST['search_student'];
        $query = "SELECT * FROM `chebisaas student data` WHERE `$column`=? AND `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$initData['inquiry'], $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }
    private function collectSearchDataPendingStudents()
    {
        $initData = $this->initCheckPageVariables();
        $column = $initData['department'] . ' status';
        $search = (int)$_POST['search_student'];
        $query = "SELECT * FROM `chebisaas student data` WHERE `$column`=? AND `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$initData['inquiry'], $search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }

    private function collectSearchDataViewStudents()
    {
        $search = (int)$_POST['search_student'];
        $query = "SELECT * FROM `chebisaas student data` WHERE `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }

    private function collectSearchDataViewShipmentDetails()
    {
        $search = $_POST['search_student'];
        $query = "SELECT * FROM `chebisaas shipment details` WHERE `admission number`=?";
        $query = $this->connectionResource()->prepare($query);
        $query->execute([$search]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        unset($query);
        return $result;
    }

    public function collectSearchData()
    {
        $checkPageRequests = [
            "view_students" => fn() => $this->collectSearchDataViewStudents(),
            "view_shipment_details" => fn() => $this->collectSearchDataViewShipmentDetails(),
            "uncleared_general" => fn() => $this->collectSearchDataUnclearedGeneral(),
            "cleared_general" => fn() => $this->collectSearchDataClearedGeneral(),
            "cleared" => fn() => $this->collectSearchDataClearedDepartment(),
            "uncleared" => fn() => $this->collectSearchDataUnclearedDepartment(),
            "pending_physical_payment" => fn() => $this->collectSearchDataPendingStudents(),
        ];

        $searchResult = $checkPageRequests[$this->initCheckPageVariables()['inquiry']]();

        return $searchResult;

    }
}
