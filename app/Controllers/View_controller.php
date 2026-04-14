<?php

namespace App\Controllers;
use App\Models\Query\Query;


class view_controller extends Query
{
    public static function Display_admin_profile_data()
    {
        return parent::Collect_admin_profile_data();
    }
    public static function Display_check_page_data(){
        return parent::Collect_check_data();
    }
    public static function Display_site_metrics(){
        return parent::Collect_site_metrics();
    }
    public static function Display_search_data(){
        if(isset($_POST['search'])){
            $_POST['pages'] = 1;
            return parent::Collect_search_data();
        }
    }
    public static function Display_notifications(){
        return parent::Notification_handler();
    }
}