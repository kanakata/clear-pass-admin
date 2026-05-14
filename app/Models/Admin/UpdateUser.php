<?php
namespace App\Models\Admin;
class UpdateUser{
    protected function Update_user()
    {
        $adm = $_POST['admission'];
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $conf = $_POST['confirmpassword'];

        if ($pass !== $conf) {
            $this->message = "😥😥😥 Update failed: Passwords do not match.";
        } else {
            $hashed = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $this->Connection_resource()->prepare("UPDATE login SET username=?, `index number`=?, year=?, password=? WHERE `admission number`=?");
            $stmt->bindParam(1, $user);
            $stmt->bindParam(2, $_POST['index']);
            $stmt->bindParam(3, $_POST['year']);
            $stmt->bindParam(4, $hashed);
            $stmt->bindParam(5, $adm);
            $stmt->execute();
            $this->message = "🥳🥳🥳 Student updated successfully!";
        }
    }
}