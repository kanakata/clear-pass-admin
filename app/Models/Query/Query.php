<?php

namespace App\Models\Query;

use App\Models\Database\Database;
use PDO;

abstract class Query extends Database
{
    protected static $connection = "";

    //resource for database connnection
    protected static function Connection_resource()
    {
        return self::$connection = parent::Database_connect("schoolclearancesite", "mysql");
    }

    //collect admin profile data
    protected static function Collect_admin_profile_data()
    {
        //collecting data for the dept page.
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $stmt = self::Connection_resource()->prepare("SELECT * FROM login WHERE `username`=?");
            $stmt->execute([$username]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $info = $result;
                return [
                    "admin_data" => $info,
                ];
            }
        } else {
            $error = "an error occurred try logging in or enabling cookie setting in your browser settings.";
        }
    }

    //collects avaiable destinations for the student
    protected static function Collect_available_destinations(): array
    {
        $destination = $_POST['location'];
        $sql = self::Connection_resource()->prepare("SELECT * FROM `shipment cost` WHERE location=? ");
        $sql->execute([$destination]);
        $destination_info = $sql->fetch(PDO::FETCH_ASSOC);
        return [
            "destinstion_info" => $destination_info
        ];
    }

    //collect search data
    protected static function Collect_search_data()
    {
        $result = null;
        $page = $_GET['page'] ?? 1;
        $rows = $_POST['pages'];
        $result_per_page = $rows <= 0 ? 10 :  $rows ?? 1;
        $search_stat = "";
        $search = $_POST['search_student'];

        //grab the inquiry  ie inquiry = cleared status = dept status ie finance status and dept ie dept=finance
        if (isset($_GET['inquiry'])) {
            $inquiry = $_GET['inquiry'];
            $department = $_GET['department'] ?? '';
            $column = $department . " status";

            // collect data for cleared student.
            if (isset($_POST['search']) && $inquiry === 'cleared') {
                $search = (int)$_POST['search_student'];
                $query = "SELECT * FROM studentgeneraldata WHERE `$column` IN ('cleared', 'online', 'pending_physical_payment') AND `admission number`=?";
                $query = self::Connection_resource()->prepare($query);
                $query->execute([$search]);
            }

            // collect next batch.
            /*elseif (isset($_POST['search']) && $inquiry === 'batch') {
                $search = (int)$_POST['search_student'];
                $query = "SELECT * FROM studentgeneraldata WHERE `$inquiry`=? AND admission=?";
                $query = self::Connection_resource()->prepare($query);
                $query->execute([$report_day, $search]);
            }*/

            // collect all student.
            elseif (isset($_POST['search']) && $inquiry === 'view_students') {
                $search = (int)$_POST['search_student'];
                $query = "SELECT * FROM studentgeneraldata WHERE `admission number`=?";
                $query = self::Connection_resource()->prepare($query);
                $query->execute([$search]);
            }

            //collect shipment detail.
            elseif (isset($_POST['search']) && $inquiry === 'view_shipment_details') {
                $search = (int)$_POST['search_student'];
                $query = "SELECT * FROM `shipment` WHERE `admission number`=?";
                $query = self::Connection_resource()->prepare($query);
                $query->execute([$search]);
            }

            //collect unclered
            elseif (isset($_POST['search']) && $inquiry !== 'cleared') {
                $search = (int)$_POST['search_student'];
                $query = "SELECT * FROM studentgeneraldata WHERE `$column`=? AND `admission number`=?";
                $query = self::Connection_resource()->prepare($query);
                $query->execute([$inquiry, $search]);
            }

            $search_result = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($search_result) {
                return [
                    "search_data" => $search_result,
                ];
            } else {
                return null;
            }

        }
    }

    //set rows cookie
    private static function Set_rows_cookie(): array
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

        // 3. Update the cookie if it's different from what's currently stored
        // This ensures the NEXT request also has the correct value
        if ($post_rows && $post_rows != $cookie_rows) {
            // Set for 30 days: time() + (86400 * 30)
            setcookie("rows", $rows, time() + 2592000, "/");
        } elseif (!$cookie_rows) {
            setcookie("rows", $default, time() + 2592000, "/");
        }

        // 4. Return the variable $rows, which is now set for the CURRENT request
        return [
            "rows" => $rows,
        ];
    }

    //collect data for the check page 
    protected static function Collect_check_data()
    {
       
        $rows = self::Set_rows_cookie()['rows'];
        $result = null;
        $page = $_GET['page'] ?? 1;
        $search = [];

        //grab the inquiry  ie inquiry = cleared status = dept status ie finance status and dept ie dept=finance
        if (isset($_GET['inquiry'])) {
            
            $inquiry = $_GET['inquiry'];
            $department = $_GET['department'] ?? '';
            $column = $department . " status";

            //collect data for cleared students only.
            if ($inquiry === 'cleared' && !isset($_GET['status'])) {
                
                //count for cleared
                $column = $department . " status";
                $query = "SELECT COUNT(`$column`) FROM studentgeneraldata WHERE `$column` IN ('cleared', 'online', 'pending_physical_payment')";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute();
                $total = $sql->fetchColumn();
                unset($sql);


                //current page
                $page = $_GET['page'] ?? 1;

                $result_per_page = $rows <= 0 ? 1 :  $rows ?? 1;
                //total number of pages

                $pages = ceil($total / $rows);

                $offset = max(0, ($page - 1) * $result_per_page);

                $query = "SELECT * FROM studentgeneraldata WHERE `$column` IN ('cleared', 'online', 'pending_physical_payment') LIMIT $offset, $result_per_page";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute();
            }

            //collect data for online, cleared,  uncleared and physial. 
            elseif ($_GET['inquiry'] != "view_students" && $_GET['status'] == "general") {
                
                //count all the columns of data on the database
                $query = "SELECT COUNT(*) FROM `studentgeneraldata` WHERE `clearancestatus`=?";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute([$inquiry]);
                $total = (int)$sql->fetchColumn();
                unset($sql);

                // collect the current page
                $page = $_GET['page'] ?? 1;

                // result per page
                $result_per_page = $rows <= 0 ? 1 : $rows ?? 1;

                //pages
                $pages = ceil($total / $rows);

                //offset
                $offset = max(0, ($page - 1) * $result_per_page);

                $query = "SELECT * FROM studentgeneraldata WHERE `clearancestatus`=? ORDER BY `admission number` ASC LIMIT $offset, $result_per_page";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute([$inquiry]);
            }
            
            //collect data for all the students only.
            elseif ($inquiry == "view_students" && $_GET['status'] == "general") {
                
                //count all the columns of data on the database
                $query = "SELECT COUNT(*) FROM `studentgeneraldata`";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute();
                $total = (int)$sql->fetchColumn();
                unset($sql);

                // collect the current page
                $page = $_GET['page'] ?? 1;

                // result per page
                $result_per_page = $rows <= 0 ? 1 : $rows ?? 1;

                //pages
                $pages = ceil($total / $rows);

                //offset
                $offset = max(0, ($page - 1) * $result_per_page);

                $query = "SELECT * FROM studentgeneraldata ORDER BY `admission number` ASC LIMIT $offset, $result_per_page";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute();
            }

            //collect fata for next batch.
            /*elseif ($inquiry == "batch") {
                $query = "SELECT COUNT(*) FROM studentgeneraldata WHERE `report date`=?";
                $sql = self::Connection_resource()->prepare($query);

                $sql->execute([$report_day]);

                //current page
                $page = $_GET['page'] ?? 1;
                //total number of rows
                $total = $sql->fetch(PDO::FETCH_ASSOC)->fetch_array()[0];
                //result to display per pag
                $rows = $_POST['pages'] ?? 1;
                $result_per_page = $rows <= 0 ? 10 :  $rows ?? 1;
                //total number of pages
                $rows = ceil($total / $result_per_page);
                //offset
                if ($page <= 0) {
                    $page = 1;
                } elseif ($page > $rows) {
                    $page = $rows;
                }
                $offset = max(0, ($page - 1) * $result_per_page);
                $path = "&inquiry=" . $_GET['inquiry'] . "&status=" . $_GET['status'] . "&dept=" . $_GET['dept'];


                $query = "SELECT * FROM studentgeneraldata WHERE `$inquiry`= ? LIMIT $offset, $result_per_page ";
                $sql = self::Connection_resource()->prepare($query);
            }*/

            //collect data for shipment requests.
            elseif ($inquiry == "view_shipment_details") {
                $query = "SELECT COUNT(*) FROM `shipment`";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute();
                $total = $sql->fetchColumn();

                //current page
                $page = $_GET['page'] ?? 1;

                $result_per_page = $rows <= 0 ? 1 :  $rows ?? 1;
                //total number of pages

                $pages = ceil($total / $rows);

                $offset = max(0, ($page - 1) * $result_per_page);

                $query = "SELECT * FROM shipment ORDER BY date ASC LIMIT $offset, $result_per_page";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute();
            }

            //collect any other data.
            else {
                $column = $department . ' status';
                $query = "SELECT COUNT(`$column`) FROM studentgeneraldata WHERE `$column`= ?";
                $sql = self::Connection_resource()->prepare($query);

                $sql->execute([$inquiry]);

                $total = $sql->fetchColumn();

                $page = $_GET['page'] ?? 1;

                // result per page
                $result_per_page = $rows <= 0 ? 1 : $rows ?? 1;

                //pages
                $pages = ceil($total / $rows);

                //offset
                $offset = max(0, ($page - 1) * $result_per_page);

                $query = "SELECT * FROM studentgeneraldata WHERE `$column`= ? LIMIT $offset, $result_per_page ";
                $sql = self::Connection_resource()->prepare($query);
                $sql->execute([$inquiry]);
            }

            $check_page_data = $sql->fetchAll(PDO::FETCH_ASSOC);
            unset($sql);

            return [
                "check_page_data" => $check_page_data,
                "page" => $page,
                "pages" => $pages,
                "total_requests" => $total,
                "tota_students" => self::Collect_site_metrics()['total_students'],
            ];

        }
    }

    //collect site metrics for the dashboard
    protected static function Collect_site_metrics()
    {
        //first delete any past login data
        self::Delete_past_logins();

        $user_type = "student";
        $uncleared = "uncleared";
        $cleared = "cleared";

        //count all the students in the database.
        $sql = self::Connection_resource()->prepare("SELECT COUNT(*) FROM studentgeneraldata WHERE `usertype`=?");
        $sql->execute([$user_type]);
        $total_students = $sql->fetchColumn();
        unset($sql);

        //count total signed up students.
        $sql = self::Connection_resource()->prepare("SELECT COUNT(*) FROM `login` WHERE usertype=?");
        $sql->execute([$user_type]);
        $total_signed_up_students = $sql->fetchColumn();
        unset($sql);

        //count total uncleared students.
        $sql = self::Connection_resource()->prepare("SELECT COUNT(*) FROM  studentgeneraldata WHERE clearancestatus=?");
        $sql->execute([$uncleared]);
        $total_uncleared_students = $sql->fetchColumn();
        unset($sql);

        //count total uncleared students.
        $sql = self::Connection_resource()->prepare("SELECT COUNT(*) FROM  studentgeneraldata WHERE clearancestatus=?");
        $sql->execute([$cleared]);
        $total_cleared_students = $sql->fetchColumn();
        unset($sql);

        //count total login data for the current date.
        $current_date = date("Y-m-d");
        $sql = self::Connection_resource()->prepare("SELECT COUNT(*) FROM  `login register` WHERE `date`=?");
        $sql->execute([$current_date]);
        $login_count = $sql->fetchColumn();
        unset($sql);

        return [
            "total_students" => $total_students,
            "total_signed_up_students" => $total_signed_up_students,
            "total_uncleared_students" => $total_uncleared_students,
            "total_cleared_students" => $total_cleared_students,
            "login_count" => $login_count
        ];
    }

    //deletes all other login data exept from that of current day
    private static function Delete_past_logins()
    {
        $current_date = date("Y-m-d");
        $sql = self::Connection_resource()->prepare("DELETE FROM  `login register` WHERE `date`!=?");
        $sql->execute([$current_date]);
        unset($sql);
    }

    //handle notifications
    protected static function Notification_handler()
    {
        //count all notifications present.
        $count = self::Connection_resource()->prepare("SELECT COUNT(*) FROM notifications");
        $count->execute();
        $count_info = $count->fetchColumn();

        //collect all notifications present.
        $check = self::Connection_resource()->prepare("SELECT * FROM notifications");
        $check->execute();
        $result = $check->fetchAll(PDO::FETCH_ASSOC);
        if (isset($_GET['delete_notification']) && $_GET['delete_notification'] == "true" && $_GET['id']) {
            $id = $_GET['id'];
            $sql = self::Connection_resource()->prepare("DELETE FROM `notifications` WHERE id=?");
            $sql->bindparam(1, $id);
            $sql->execute();
        }

        return [
            "notification(s)" => $result,
            "notification_count" => $count_info,
        ];
    }
}