<?php
namespace  App\Models\Auth;
class Register{
    private $message;
    protected function registerUser()
    {

        $credentials = [
            'csrf'             => $_POST['csrf'],
            'firstname'        => $_POST['firstname'],
            'lastname'         => $_POST['lastname'],
            'schoolemail'      => $_POST['schoolemail'],
            'schoolphone'      => $_POST['schoolphone'],
            'schoolname'       => $_POST['schoolname'],
            'userid'           => $_POST['userid'],
            'securitynumber'   => $_POST['securitynumber'],
            'password'         => $_POST['password'],
            'confirm_password' => $_POST['confirmpassword']
        ];

        $sanitizedCredentials = array_map('parent::sanitize', $credentials);

        if ($_SESSION['csrf'] !== $sanitizedCredentials['csrf']) return;
        //heck if the password and comfirm passwords field are the same.
        if ($sanitizedCredentials['password'] !== $sanitizedCredentials['confirm_password']) {
            $this->message = "😥😥😥 The passwords you entered do not match.";
        } else {
            //Hashing the password
            $hashed_pass = password_hash($sanitizedCredentials['password'], PASSWORD_DEFAULT);
            $hashed_securiry_number = password_hash($sanitizedCredentials['securitynumber'], PASSWORD_DEFAULT);
            $username = $sanitizedCredentials['firstname'] . $sanitizedCredentials['lastname'];
            $check = $this->Connection_resource()->prepare("SELECT `user id` FROM `login` WHERE `user id`=?");
            $check->bindParam(1, $sanitizedCredentials['userid']);
            $check->execute();
            $this->result = $check->fetchColumn();

            if ($this->result >= 1) {
                $this->message = "😥😥 oops!! An account with those credentials already already exists. try logging into you account.";
            } else {

                $sql = self::Connection_resource()->prepare("INSERT INTO `login` (`user id`, `username`, `school email`, `school phone`, `school name`, `security number`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?)");

                if ($sql->execute([$sanitizedCredentials['userid'], $username, $sanitizedCredentials['schoolemail'], $sanitizedCredentials['schoolphone'],  $sanitizedCredentials['schoolname'], $hashed_securiry_number, $hashed_pass])) {
                    $_SESSION['action status'] = "Registration sucessfull! Please log in.";
                } else {
                    $this->message = "😥😥😥 Sorry could not process your request, please try again later.";
                }
            }
        }

        return  $this->message;
    }
}
