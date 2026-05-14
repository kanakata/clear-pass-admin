<?php
namespace App\Models\Payments;

use App\Models\Payments\E_citizen\E_citizen;
use App\Models\Payments\Mpesa\Mpesa;
use BcMath\Number;

class Payments{
    public function Payment_handler($payment_method){

        $mpesa = new Mpesa();
        $ecitizen = new E_citizen();
        echo $amount = (int)$_SESSION['amount'];
        echo $amount = (int) number_format($amount, 0, "", "");
        $payment_methods = [
            "mpesa" => fn() => $mpesa->Stk_push($_SESSION['account'], $amount),
            "e_citizen" => fn() => $ecitizen->E_citizen(),
            "test" => fn() => $ecitizen->Test(),
        ];

        $payment_methods[$payment_method]();

    }
}