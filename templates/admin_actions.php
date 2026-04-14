<?php
$action_status = "";
$page_title = "admin-actions";

use App\Controllers\Api_controller;
use App\Controllers\view_controller;

$admin_profile = view_controller::Display_admin_profile_data()['admin_data'];
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $action_status = Api_controller::Admin_actions()['message'];
}
require_once ROOT . "/require/header.php";
require_once ROOT . "/templates/components/vendor.php";
$action = $_GET['action'] ?? "";
?>
<nav>
    <h2><img src="./assets/icons/dashboard.png" alt="">Admin actions</h2>
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

<div class="actions">
    <?php require_once ROOT . $admin_actions_page[$action] ?>
</div>

<?php if (!empty($action_status)): ?>
    <div class="alert" style="display: <?php echo "block" ?>;">
        <div class="alert_title">alert</div>
        <div class="close">close<img src="./assets/icons/x.svg" alt=""></div>
        <div class="alert_message"><?= $action_status ?></div>
    </div>
<?php endif; ?>

<?php require_once ROOT . "/require/footer.php" ?>