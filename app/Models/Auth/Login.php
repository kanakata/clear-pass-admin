<?php

namespace App\Models\Auth;

use App\Middleware\Database;
use App\Middleware\Sanitize;
use App\Middleware\Sanitize as MiddlewareSanitize;
use App\Models\Paywall\Paywall;
use PDO;

class Login extends Database
{
    private $connection = null;
    private string $message;
    private $result;
    public function loginUser()
    {
        $credentials = [
            "firstname"       => $_POST['firstname'],
            "lastname"        => $_POST['lastname'],
            'schoolemail'     => $_POST['schoolemail'],
            "schoolname"      => $_POST['schoolname'],
            "userid"          => $_POST['userid'],
            "securitynumber"  => $_POST['securitynumber'],
            "csrf"            => $_POST['csrf'],
            "password"        => $_POST['password'],
        ];


        $sanitizedCredentials = $credentials;

        $username = $sanitizedCredentials['firstname'] . " " . $sanitizedCredentials['lastname'];

        if ($_SESSION['csrf'] !== $sanitizedCredentials['csrf']) {
            header("location: /404");
            exit();
        } else {

            $stmt = $this->connectionResource()->prepare(("SELECT * FROM `login` WHERE `user id`=? AND `username`=?"));
            $stmt->execute([$sanitizedCredentials['userid'], $username]);
            $this->result = $stmt->fetch(PDO::FETCH_ASSOC);
            unset($stmt);

            if ($this->result) {
                if ($sanitizedCredentials['schoolname'] != $this->result['school name']) return;
                // Verify the hashed password.
                if (password_verify($sanitizedCredentials['password'], $this->result['password']) && password_verify($sanitizedCredentials['securitynumber'], $this->result['security number'])) {

                    $_SESSION['school_name'] = $sanitizedCredentials['schoolname'] ?? null;
                    $_SESSION['username'] = $this->result['username'];
                    $_SESSION['school_phone'] = $this->result['school phone'];
                    $_SESSION['school_email'] = $sanitizedCredentials['schoolemail'];

                    $paywall = new Paywall();
                    if ($paywall->Paywall() == false) {
                        header("location: /pricing");
                        exit();
                    } else {
                        session_regenerate_id(true);
                        $_SESSION['message'] = "🥳🥳🥳 Login successful! Welcome to your dashboard.";
                        header("location: /dashboard");
                        exit();
                    }
                } else {
                    $this->message = "Invalid credentials. Please try again.";
                }
            } else {
                $this->message = "No account found with those details. Please try again with the right credentials.";
            }

            return $this->message;
        }
    }
}
