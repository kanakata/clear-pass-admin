<?php
namespace App\Models\Message;
abstract class Message{
    public static function Set_message($message){
        return [
            "message" => $message,
        ];
    }
}