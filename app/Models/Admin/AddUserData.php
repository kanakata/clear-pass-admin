<?php
namespace App\Models\Admin;
class AddUserData{
    private function Add_user_data()
    {
        $sql = "SELECT `admission number` FROM `chebisaas student data` WHERE `admission number`=?";
        $sql = $this->Connection_resource()->prepare($sql);
        $sql->execute([$_POST['admission']]);
        $this->result = $sql->fetchColumn();

        if ($this->result >= 1) {
            $this->message = "😥😥😥 User data already exists!!";
            unset($sql);
        } else {
            $laborarory_value = isset($_POST['laboratoryvalue']) ? $_POST['laboratoryvalue'] + 200 : null;
            $data = [
                $_POST['admission'],
                $_POST['index'],
                $_POST['username'],
                $_POST['financedebt'] ?? null,
                $_POST['financevalue'] ?? null,
                $_POST['librarydebt'] ?? null,
                $_POST['libraryvalue'] ?? null,
                $_POST['boardingdebt'] ?? null,
                $_POST['boardingvalue'] ?? null,
                $_POST['logisticsdebt'] ?? null,
                $_POST['logisticsvalue'] ?? null,
                $_POST['gamesdebt'] ?? null,
                $_POST['gamesvalue'] ?? null,
                $_POST['laboratorydebt'] ?? null,
                $laborarory_value,
            ];

            $sql = "INSERT INTO `chebisaas student data` (
                        `admission number`, `index number`, `username`,
                        `finance debt`, `finance value`, 
                        `library debt`, `library value`, 
                        `boarding debt`, `boarding value`,
                        `laboratory debt`, `laboratory value`, 
                        `logistics debt`, `logistics value`,
                        `games debt`, `games value`
                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            try {
                $sql = $this->Connection_resource()->prepare($sql);

                if ($sql->execute([...$data])) {
                    unset($sql);
                    $this->message = "🥳🥳🥳 Full clearance record uploaded for user:  " . $_POST['admission'];
                } else {
                    $this->message = "😥😥😥 Error uploading data for user {$_POST['admission']}, please try again.";
                    throw new Exception();
                }
            } catch (Exception $e) {
                echo $this->error = "Error " . $e->getMessage() . " on file: " . $e->getFile() . " on line: " . $e->getLine();
            }
        }

        return [
            "message" => $this->message,
        ];
    }
}