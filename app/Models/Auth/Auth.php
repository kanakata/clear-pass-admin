<?php

namespace App\Models\Auth;

use App\Middleware\Middleware;
use PDO;
use Exception;
abstract class Auth extends Middleware
{

    //log in the user. 
    protected static function Log_in()
    {
        $message = "";
        // Sanitize inputs
        $firstname = trim($_POST['firstname']);
        $lastname  = trim($_POST['lastname']);
        $sirname   = trim($_POST['sirname']);
        $admission = trim($_POST['admission']);
        $index     = trim($_POST['index']);
        $year     = trim($_POST['year']);
        $password  = $_POST['password'];

        $username = trim($firstname . " " . $lastname . " " . $sirname);

        // Using self::General_connection_resource() (ensure this matches your db_connect.php file)
        $stmt = self::General_connection_resource()->prepare("SELECT * FROM login WHERE `admission number`=? AND `index number`=? AND `username`=? AND `year`=?");
        $stmt->execute([$admission, $index, $username, $year]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $user = $result;

            // Verify the hashed password.
            if (password_verify($password, $user['password']) && $user['usertype'] == "admin") {
                // Regenerate session ID to prevent session fixation attacks
                session_regenerate_id(true);
                $_SESSION['username'] = $user['username'];
                //set message for a successful login.
                $_SESSION['message'] = "Login successful!";
                $get_ip = $_SERVER['REMOTE_ADDR'];

                //Check if user exists in the register table.
                $check = self::General_connection_resource()->prepare("SELECT `admission` FROM `login register` WHERE `admission` = ? AND `username` = ?");
                $check->bindParam(1, $admission);
                $check->bindParam(2, $_SESSION['username']);
                $check->execute();
                $result = $check->fetchColumn();
                if (empty($result)) {
                    $sql = self::General_connection_resource()->prepare("INSERT INTO `login register` (username, admission, ip) VALUE (?,?,?)");
                    $message = "welcome to your dashboard";
                    $sql->execute([$username, $admission, $get_ip]);
                    header("location: /dashboard");
                    exit();
                }else{
                    $message = "welcome to your dashboard";
                    header("location: /dashboard");
                    exit();
                }
            } else {
                //initialise the brute force mitigator if the password does not match.
                self::Brute_force_mitigator($admission, $_SERVER['REMOTE_ADDR']);
                $message = "Invalid credentials. Please try again.";
            }
        } else {
            //initialise the brute force mitigator if the credentials are not the same.
            self::Brute_force_mitigator($admission, $_SERVER['REMOTE_ADDR']);
            $message = "No account found with those details. Please try again with the right credentials.";
        }
        return [
            "message" => $message
        ];
    }

    //register the user.
    protected static function Register()
    {
        if (isset($_POST['sign']) && !empty($_POST['lastname'])) {

            //ollect all the form data
            $firstname = trim($_POST['firstname']);
            $lastname  = trim($_POST['lastname']);
            $sirname   = trim($_POST['sirname']);
            $admission = (int)$_POST['admission'];
            $index     = (int)$_POST['index'];
            $year      = (int)$_POST['year'];
            $password  = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $usertype  = "student";

            //heck if the password and comfirm passwords field are the same.
            if ($password !== $confirm_password) {
                $error = "The passwords you entered do not match.";
            } else {
                //Hashing the password 
                $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
                //oncatenate the firstname last name and user name
                $username = trim("$firstname $lastname $sirname");
                $username = htmlspecialchars($username);

                //Check if user exists in the database
                $check = self::General_connection_resource()->prepare("SELECT `admission number` FROM login WHERE `admission number` = ? OR `index number` = ?");
                $check->bindParam("1", $admission);
                $check->bindParam("2", $index);
                $check->execute();
                $result = $check->fetch(PDO::FETCH_ASSOC);

                if ($result->num_rows > 0) {
                    $error = "An account with this Admission or Index number already exists.";
                } else {
                    //ploading the user image to the user profile folder and inserting the image link in the database

                    //Final Insert (using $hashed_pass and the correct $sql statement)
                    if (true) {
                        $sql = self::General_connection_resource()->prepare("INSERT INTO login (username, `admission number`, `index number`, year, usertype, password) VALUES (?, ?, ?, ?, ?, ?, )");

                        if ($sql->execute([$username, $admission, $index, $year, $usertype, $hashed_pass])) {
                            $_SESSION['sign_mesa$message'] = "Registration sucessful! Please log in.";
                            $message = $username . " admission " . $admission . " has successfully signed up.";
                            $check = self::General_connection_resource()->prepare("INSERT INTO notifications (username, admission, message) VALUES (?, ?, ?)");
                            $check->execute([$username, $admission, $message]);
                        } else {
                            $error = "Database error: Could not register user.";
                        }
                    }
                }
            }
        }
    }

    //add and update student data
    protected static function Add_update_students()
    {
        $message = null;
        $username = "";

        //update logic
        if (isset($_POST['update'])) {
            $adm = $_POST['admission'];
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $conf = $_POST['confirmpassword'];  

            if ($pass !== $conf) {
                $message = "Update failed: Passwords do not match.";
            } else {
                $hashed = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = self::General_connection_resource()->prepare("UPDATE login SET username=?, `index number`=?, year=?, password=? WHERE `admission number`=?");
                $stmt->bindParam(1, $user);
                $stmt->bindParam(2, $_POST['index']);
                $stmt->bindParam(3, $_POST['year']);
                $stmt->bindParam(4, $hashed);
                $stmt->bindParam(5, $adm);
                $stmt->execute();
                $message = "Student updated successfully!";
            }
        }

        if (isset($_POST['manually_sign'])) {
            // 1. Capture and Trim all inputs
            $admission = isset($_POST['admission']) ? (int)trim($_POST['admission']) : 0;
            $firstname = trim($_POST['firstname'] ?? '');
            $lastname  = trim($_POST['lastname'] ?? '');
            $sirname   = trim($_POST['sirname'] ?? '');
            $index     = isset($_POST['index']) ? (int)trim($_POST['index']) : 0;
            $year      = isset($_POST['year']) ? (int)trim($_POST['year']) : 0;

            // 2. Passwords should be trimmed if you don't want accidental leading/trailing spaces
            $pass = trim($_POST['password'] ?? '');
            $conf = trim($_POST['confirmpassword'] ?? '');

            // 3. Construct username after trimming individual parts
            $username = trim($firstname . " " . $lastname . " " . $sirname);
            $student = "student";

            if (empty($pass) || empty($firstname) || $admission === 0) {
                $message = "Registration failed: All required fields must be filled.";
            } elseif ($pass !== $conf) {
                $message = "Sign up failed: Passwords do not match.";
            } else {
                // --- CHECK IF USER EXISTS ---
                $check_stmt = self::General_connection_resource()->prepare("SELECT `admission number` FROM login WHERE `admission number` = ?");
                $check_stmt->bindParam(1, $admission);
                $check_stmt->execute();
                $result = $check_stmt->fetchColumn();
                if ($result >= 1) {
                    $message = "Error: A student with Admission Number $admission is already registered.";
                } else {
                    // Hash the trimmed password
                    $hashed = password_hash($pass, PASSWORD_DEFAULT);

                    $stmt = self::General_connection_resource()->prepare("INSERT INTO login (username, `admission number`, `index number`, year, usertype, password) VALUES (?,?,?,?,?,?)");

                    try {
                        $stmt->bindParam(1, $username);
                        $stmt->bindParam(2, $admission);
                        $stmt->bindParam(3, $index);
                        $stmt->bindParam(4, $year);
                        $stmt->bindParam(5, $student);
                        $stmt->bindParam(6, $hashed);
                        if ($stmt->execute()) {
                            $message = "Student " . $firstname . " registered successfylly!";
                        } else {
                            $message = "Something went wrong during registration.";
                        }
                        unset($stmt);
                    } catch (Exception $e) {
                        $error = "Database Error: " . $e->getMessage();
                    }
                }
                unset($check_stmt);
            }
        }

        //upload batch
        if (isset($_POST['uploaddata'])) {
            // 1. Map POST data to match the EXACT order of the SQL columns below
            // Note: I removed 'username' because it wasn't in your SQL column list
            $data = [
                $_POST['username'],                  // username
                $_POST['admission'],                  // admission number (assuming same as admission)
                $_POST['index'],                      // index number
                $_POST['year'],                       // year
                $_POST['feedebt'],                    // finance debt
                $_POST['financevalue'],               // finance value
                $_POST['feestatus'],                  // finance status
                $_POST['bookslost'],                  // library debt
                $_POST['bookvalue'],                  // library value
                $_POST['librarystatus'],              // library status
                $_POST['boardingitemsdamged'],        // boarding debt
                $_POST['boardingitemsdamagedmarketvalue'], // boarding value
                $_POST['boardingstatus'],             // boarding status
                $_POST['accessoriesdebt'],            // accessories debt
                $_POST['accessoriesvalue'],           // accessories value
                $_POST['accessoriesstatus'],          // accessories status
                $_POST['gamesitemlost'],              // games debt
                $_POST['gamesitemlostmarketvalue'],   // games value
                $_POST['gamesstatus'],                // games status
                $_POST['labitemsdamaged'],            // laboratory debt
                ($_POST['labitemsdamagedvalue'] + 200),       // laboratory value
                $_POST['labstatus']                   // laboratory status
            ];

            // 2. SQL Statement (22 Columns, 22 Placeholders)
            $sql = "INSERT INTO studentgeneraldata (
                    `username`, `admission number`, `index number`, `year`,
                    `finance debt`, `finance value`, `finance status`, 
                    `library debt`, `library value`, `library status`,
                    `boarding debt`, `boarding value`, `boarding status`, 
                    `accessories debt`, `accessories value`, `accessories status`,
                    `games debt`, `games value`, `games status`,
                    `laboratory debt`, `laboratory value`, `laboratory status`
                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            try {
                $stmt = self::General_connection_resource()->prepare($sql);
                // 3. Bind Parameters (22 "s" for strings, or use "i" for integers where appropriate)
                // types: admission(i), adm_num(i), index(s), year(i)... adjust as per your DB
                if ($stmt->execute([...$data])) {
                    $message = "Full clearance record updated for ADM: " . $_POST['admission'];
                } else {
                    throw new Exception();
                }
                unset($sql);
            } catch (Exception $e) {
            }
        }

        return [
            "message" => $message
        ];

    }
}