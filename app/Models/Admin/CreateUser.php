<?php
namespace App\Models\Admin;
class CreateUser{
    private function Manually_sign_in_user()
    {

        $admission = isset($_POST['admission']) ? $_POST['admission'] : 0;
        $sanitizedCredentials['firstname'] = $_POST['firstname'] ?? '';
        $sanitizedCredentials['lastname']  = $_POST['lastname'] ?? '';
        $sirname   = $_POST['sirname'] ?? '';
        $index     = isset($_POST['index']) ? $_POST['index'] : 0;
        $usertype      = isset($_POST['usertype']) ? $_POST['usertype'] : null;
        $position      = isset($_POST['position']) ? $_POST['position'] : null;
        $security_number      = isset($_POST['security_number']) ? $_POST['security_number'] : null;
        $pass = $_POST['password'] ?? '';
        $conf = $_POST['confirmpassword'] ?? '';

        $username = $sanitizedCredentials['firstname'] . " " . $sanitizedCredentials['lastname'] . " " . $sirname;

        if ($usertype == "admin") {
            //remove in prod
            $plan_accounts = [
                'basic' => 2,
                'premium' => 5,
            ];
            $subscription_data = new Query();
            $plan = strtolower($subscription_data->Collect_school_subscription_data()['subscription_plan']);

            $plan_limit = $plan_accounts[$plan];
            if ($pass == $conf) {
                // --- CHECK IF USER EXISTS ---
                $sql = "SELECT * , COUNT(*) AS plan_accounts FROM `login` WHERE `school name`=?";
                $sql = $this->Connection_resource()->prepare($sql);
                $sql->execute([$_SESSION['school_name']]);
                $result = $sql->fetch(PDO::FETCH_ASSOC);

                if ($result['plan_accounts'] == $plan_limit) {
                    $this->message = "😥😥😥 your accounts limit is exeeded please upgrade to continue.";
                } else {

                    $check_stmt = $this->Connection_resource()->prepare("SELECT `user id` FROM `login` WHERE `user id` = ? AND `username`=?");
                    $check_stmt->bindParam(1, $index);
                    $check_stmt->bindParam(2, $username);
                    $check_stmt->execute();
                    $this->result = $check_stmt->fetchColumn();
                    unset($check_stmt);
                    if ($this->result >= 1) {

                        $this->message = "😥😥😥 Error: a user with this credentials is already registered.";
                    } else {

                        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                        $hashed_security_number = password_hash($security_number, PASSWORD_DEFAULT);

                        $stmt = $this->Connection_resource()->prepare("INSERT INTO `login` (`user id`, `username`, `school email`, `school phone`, `school name`, `position`, `security number`, `password` ) VALUES (?,?,?,?,?,?,?,?)");

                        try {

                            $stmt->bindParam(1, $index);
                            $stmt->bindParam(2, $username);
                            $stmt->bindParam(3, $result['school email']);
                            $stmt->bindParam(4, $result['school phone']);
                            $stmt->bindParam(5, $_SESSION['school_name']);
                            $stmt->bindParam(6, $position);
                            $stmt->bindParam(7, $hashed_security_number);
                            $stmt->bindParam(8, $hashed_password);

                            if ($stmt->execute()) {

                                $this->message = "🥳🥳🥳 User " . $sanitizedCredentials['firstname'] . " registered successfylly!!";
                            } else {

                                $this->message = "😥😥😥 Something went wrong during registration. Please try again later!!";
                            }

                            unset($stmt);
                        } catch (Exception $e) {
                            $this->error = "Database Error: " . $e->getMessage();
                        }
                    }
                }
            } else {
                $this->message = "😥😥😥 Error!! : Passwords do not match.";
            }
        } else {
            //remove in prod

            if ($pass == $conf) {

                // --- CHECK IF USER EXISTS ---
                $check_stmt = $this->Connection_resource()->prepare("SELECT `admission number` FROM `chebisaas login` WHERE `admission number` = ?");
                $check_stmt->bindParam(1, $admission);
                $check_stmt->execute();
                $this->result = $check_stmt->fetchColumn();
                unset($check_stmt);

                if ($this->result >= 1) {

                    $this->message = "😥😥😥 Error: a user with this credentials is already registered.";
                } else {

                    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                    $stmt = $this->Connection_resource()->prepare("INSERT INTO `chebisaas login` (`admission number`, `index number`, `username`, `school name`, `password`, `usertype`) VALUES (?,?,?,?,?,?)");

                    try {
                        $stmt->bindParam(1, $admission);
                        $stmt->bindParam(2, $index);
                        $stmt->bindParam(3, $username);
                        $stmt->bindParam(4, $_SESSION['school_name']);
                        $stmt->bindParam(5, $hashed_password);
                        $stmt->bindParam(6, $usertype);
                        if ($stmt->execute()) {
                            $this->message = "🥳🥳🥳 User " . $sanitizedCredentials['firstname'] . " registered successfylly!!";
                        } else {
                            $this->message = "😥😥😥 Something went wrong during registration. Please try again later!!";
                        }

                        unset($stmt);
                    } catch (Exception $e) {
                        $this->error = "Database Error: " . $e->getMessage();
                    }
                }
            } else {
                $this->message = "😥😥😥 Data upload failed !! : Passwords do not match.";
            }
        }

        return [
            "message" => $this->message,
        ];
    }
}