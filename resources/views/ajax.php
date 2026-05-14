<?php

use App\Controllers\view_controller;

if(isset($_GET['page']) || isset($_GET['inquiry'])){
    $checkAjax = new view_controller();
    $checkAjaxData = $checkAjax->Display_check_page_data();

    header("Content-Type: application/json");
    echo $checkAjaxData['check_page_data'];
}
