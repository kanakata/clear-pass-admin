<?php

namespace App\Controllers;

use App\Models\Query\CheckQuery;
use App\Models\Query\SharedQueries;

class CheckController extends SharedQueries
{

    public function show()
    {
        $controller = new CheckQuery();
        $pageData = $controller->collectCheckData()['checkPageData'];
        $departments = SharedQueries::collectSchoolSubscriptionData()['departments'];

        if (isset($_POST['search'])) {
            if ($controller->collectSearchData() == null) {
                $search_status = null;
            } else {
                $search_status = [];
                $searchData = $controller->collectSearchData() ?? null;
            }

            unset($_POST['search'], $_POST['search_student']);
        }

        $page = (int)$controller->collectCheckData()['page'];
        $pages = (int)$controller->collectCheckData()['pages'];
        $inquiry = $_GET['inquiry'];

        return[
            require ROOT . "/resources/views/components/vendor.php",
            require ROOT . "/resources/views/check.php",
        ];
    }
}
