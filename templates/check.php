<?php

use App\Controllers\view_controller;

$search_status = [];
$page_title = $_GET['department']  ?? "view students" . "-" . $_GET['inquiry'];
$check_data = view_controller::Display_check_page_data();
$page_data = $check_data['check_page_data'];
if (isset($_POST['search'])) {
    if (view_controller::Display_search_data() == null) {
        $search_status = null;
    } else {
        $search_status = [];
        $search_data = view_controller::Display_search_data()['search_data'];
    }
}
$page = $check_data['page'];
$pages = $check_data['pages'];
require_once ROOT . "/require/header.php";
require_once ROOT . "/templates/components/vendor.php";
$inquiry = $_GET['inquiry'];
?>

<nav>
    <h2><img src="./assets/icons/<?= $_GET['department'] ?? "dashboard" ?>.png" alt=""><?php echo $_GET['department']  ?? "" . "-" . $_GET['inquiry'] ?></h2>
    <div class="links">
        <div class="mode">
            <div class="mode_set"></div>
        </div>
        <div class="sun_moon">
            <img src="./assets/icons/sun.png" alt="" class="weather">
        </div>
        <a href="/dashboard"><img src="./assets/icons/back.png" alt="">Back</a>
    </div>
</nav>

<h2 class="welcome">Search for a specific student.</h2>

<?php require_once ROOT . $check_page["search"] ?>

<h2 class="welcome">
    <?php if (isset($_GET['department'])): ?>
        <?= ($check_data['total_requests'] == 1 ? $check_data['total_requests'] . "/" . $check_data['tota_students'] . " student (" : $check_data['total_requests'] . "/" . $check_data['tota_students']  . " students (") . ceil(($check_data['total_requests'] / $check_data['tota_students']) * 100) . "% " . $_GET['inquiry'] . " in the " . $_GET['department'] . " department. ) " ?>
    <?php else: ?>
        <?= ($check_data['total_requests'] == 1 ? $check_data['total_requests'] . " student (" : $check_data['total_requests'] . " students (") . ceil(($check_data['total_requests'] / $check_data['tota_students']) * 100) . "% of students )" ?>
    <?php endif; ?>
</h2>

<div class="pages-to-display">
    <form action="" method="post">
        <label for="pages">
            Page: <?= $page . "/" . $pages ?>. Type rows to display.
            <!-- display the number of rows from the cookie. If missing default to 10 -->
            <input type="number" placeholder="" value="<?= isset($_COOKIE['rows']) ? $_COOKIE['rows'] : 10 ?>" name="rows">
        </label>
    </form>
</div>

<?php require_once ROOT . $check_page[$inquiry] ?>

<!-- pagination -->
<?php if ($page_data != null): ?>
    <?php
    // 1. Get the current path without ANY query parameters (e.g., /check)
    $current_path = strtok($_SERVER['REQUEST_URI'], '?');

    // 2. Get current GET parameters
    $params = $_GET;
    // Function to build a clean link for a specific page
    $get_link = function ($target_page) use ($current_path, $params) {
        $params['page'] = $target_page; // Set or overwrite the page
        return htmlspecialchars($current_path . '?' . http_build_query($params));
    };
    ?>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="<?= $get_link($page - 1) ?>" class="prev">previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <div class="numbers <?= ($i == $page) ? 'active' : '' ?>">
                <a href="<?= $get_link($i) ?>"><?= "Pg: " . $i ?></a>
            </div>
        <?php endfor; ?>

        <?php if ($page < $pages): ?>
            <a href="<?= $get_link($page + 1) ?>" class="next">next</a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php require_once ROOT . "/require/footer.php" ?>